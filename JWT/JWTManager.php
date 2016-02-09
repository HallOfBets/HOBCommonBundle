<?php
namespace HOB\CommonBundle\JWT;

use HOB\CommonBundle\JWT\Encoder\JWTEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Class JWTManager
 * @package HOB\CommonBundle\JWT
 */
class JWTManager
{
    /**
     * @var JWTEncoderInterface
     */
    protected $jwtEncoder;
    /**
     * @var integer
     */
    protected $ttl;


    /**
     * JWTManager constructor.
     * @param JWTEncoderInterface $encoder
     * @param $ttl
     */
    public function __construct(JWTEncoderInterface $encoder, $ttl)
    {
        $this->jwtEncoder        = $encoder;
        $this->ttl               = $ttl;
    }

    /**
     * @param TokenInterface $token
     * @return array|bool
     */
    public function decode(TokenInterface $token)
    {
        if (!($payload = $this->jwtEncoder->decode($token->getCredentials()))) {
            return false;
        }

        return $payload;
    }
}
