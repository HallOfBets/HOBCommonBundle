<?php
namespace HOB\CommonBundle\Serializer;

use JMS\Serializer\Construction\ObjectConstructorInterface;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\Metadata\ClassMetadata;
use JMS\Serializer\VisitorInterface;

/**
 * Class ObjectConstructor
 * @package HOB\CommonBundle\Serializer
 */
class ObjectConstructor implements ObjectConstructorInterface
{
    /**
     * @inheritDoc
     */
    public function construct(
        VisitorInterface $visitor,
        ClassMetadata $metadata,
        $data,
        array $type,
        DeserializationContext $context
    ) {
        $className = $metadata->name;

        return new $className();
    }
}
