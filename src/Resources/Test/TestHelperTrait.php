<?php

namespace Resources\Test;

trait TestHelperTrait
{
    public function invokePropertyClass($class, $obj, string $propertyName)
    {
        $reflectionClass = new \ReflectionClass($obj);

        $reflectionProperty = $reflectionClass->getProperty($propertyName);
        $reflectionProperty->setAccessible(true);

        return $reflectionProperty->getValue(new $class);
    }

    public function invokeAllPropertiesClass($obj)
    {
        $reflectionClass = new \ReflectionClass($obj);

        return $reflectionClass->getProperties(\ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PROTECTED);
    }
}
