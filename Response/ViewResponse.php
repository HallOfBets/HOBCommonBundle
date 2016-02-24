<?php
namespace HOB\CommonBundle\Response;

use Doctrine\ORM\Tools\Pagination\Paginator;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\View\View;
use HOB\CommonBundle\Pagination\Pagination;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ViewResponse
 * @package HOB\CommonBundle\Response
 */
class ViewResponse
{
    /**
     * @var Pagination
     */
    private $pagination;

    /**
     * ViewResponse constructor.
     * @param Pagination $pagination
     */
    public function __construct(Pagination $pagination)
    {
        $this->pagination = $pagination;
    }

    /**
     * @param Request $request
     * @param array $parameters
     * @param Paginator $paginator
     * @param array $serializerGroups
     * @return View
     */
    public function createView(Request $request, array $parameters, Paginator $paginator, array $serializerGroups = [])
    {
        return $this->create($request, $parameters, $paginator->getQuery()->getResult(), $paginator->count(), $serializerGroups);
    }

    /**
     * @param Request $request
     * @param array $parameters
     * @param $viewContent
     * @param $itemsNumber
     * @param array $serializerGroups
     * @return View
     */
    public function create(Request $request, array $parameters, $viewContent, $itemsNumber, array $serializerGroups = [])
    {
        $view       = View::create($viewContent);
        $headers    = $view->getHeaders();

        $paginationHeader   = $this->pagination->getHeader($request->get('_route'), $itemsNumber, $parameters);
        $headers            = array_merge($headers, $paginationHeader);

        $view->setHeaders($headers);

        $context = new Context();
        $context->addGroups($serializerGroups);

        $view->setContext($context);

        return $view;
    }
}
