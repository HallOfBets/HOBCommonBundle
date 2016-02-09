<?php
namespace HOB\CommonBundle\JWT\Encoder;

/**
 * Interface JWTEncoderInterface
 * @package HOB\CommonBundle\JWT\Encoder
 */
interface JWTEncoderInterface
{
    /**
     * @param array $data
     *
     * @return string the encoded token string
     */
    public function encode(array $data);
    /**
     * @param string $token
     *
     * @return bool|array
     */
    public function decode($token);
}