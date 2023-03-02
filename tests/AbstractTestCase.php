<?php

namespace App\Tests;

use Helmich\JsonAssert\JsonAssertions;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;

abstract class AbstractTestCase extends TestCase
{
    use JsonAssertions;

    /**
     * Sets a protected property on a given object via reflection
     *
     * @param $object - instance in which protected value is being modified
     * @param $mockObject
     * @param $property - property on instance being modified
     * @param $value - new value of the property being modified
     *
     * @return void
     * @throws ReflectionException
     */
    public function setPrivateProperty($object, $mockObject, $property, $value): void
    {
        $reflection = new ReflectionClass($object);
        $reflectionProperty = $reflection->getProperty($property);
        $reflectionProperty->setValue($mockObject, $value);
    }

    protected function setEntityId(object $entity, int $value, $idField = 'id')
    {
        $class = new ReflectionClass($entity);
        $property = $class->getProperty($idField);
        $property->setValue($entity, $value);
    }
}