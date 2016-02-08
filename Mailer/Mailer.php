<?php

namespace HOB\CommonBundle\Mailer;

use Symfony\Component\Templating\EngineInterface;

/**
 * Class Mailer
 * @package HOB\UserBundle\Mailer
 */
class Mailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @param \Swift_Mailer $mailer
     * @param $fromAddress
     */
    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating, $fromAddress)
    {
        $this->mailer       = $mailer;
        $this->templating   = $templating;
        $this->fromAddress  = $fromAddress;
    }

    /**
     * @param $template
     * @param array $templateVars
     * @return string
     */
    public function renderTemplate($template, array $templateVars = [])
    {
        $templateFormated = $this->templating->render($template, $templateVars);

        return $templateFormated;
    }

    /**
     * @param $templatePath
     * @param array $templateVars
     * @param $toAddress
     * @param array $ccAddress
     */
    public function buildAndSendTemplate($templatePath, array $templateVars = [], $toAddress, array $ccAddress = [])
    {
        $template = $this->renderTemplate($templatePath, $templateVars);

        $this->sendTemplate($template, $toAddress, $ccAddress);
    }

    /**
     * @param $template
     * @param $toAddress
     * @param array $ccAddress
     */
    public function sendTemplate($template, $toAddress, array $ccAddress = [])
    {
        // Render the email, use the first line as the subject, and the rest as the body
        $renderedLines  = explode("\n", trim($template));
        $subject        = $renderedLines[0];
        $body           = implode("\n", array_slice($renderedLines, 1));

        $this->send($subject, $body, $toAddress, $ccAddress);
    }

    /**
     * @param $subject
     * @param $body
     * @param $toAddress
     * @param array $ccAddress
     * @return bool
     */
    public function send($subject, $body, $toAddress, array $ccAddress = [])
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($this->fromAddress)
            ->setTo($toAddress)
            ->setBody($body)
            ->setContentType("text/html");

        if(!empty($ccAddress)){
            $message->setCc($ccAddress);
        }

        $this->mailer->send($message);

        return true;
    }
}
