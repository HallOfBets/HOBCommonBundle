<?php
namespace HOB\CommonBundle\Serializer;

use JMS\Serializer\GenericDeserializationVisitor;

/**
 * Class FormDeserializationVisitor
 * @package HOB\CommonBundle\Serializer
 */
Class FormDeserializationVisitor extends GenericDeserializationVisitor
{
    /**
     * @param $str
     * @return array
     */
    protected function decode($str)
    {
        parse_str($str, $output);

        return $output;
    }
}
