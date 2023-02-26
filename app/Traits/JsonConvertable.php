<?php

namespace NutriScore\Traits;

use ReflectionClass;

trait JsonConvertable {
    public function jsonSerialize(): array {
        $class_name = get_class($this);
        $reflection = new ReflectionClass($class_name);
        $privateProperties = $reflection->getProperties();

        $result = [];
        foreach ($privateProperties as $property) {
            $property->setAccessible(true);
            $name = $property->getName();
            $value = $property->getValue($this);
            $result[$name] = $value;
        }

        return $result;
    }
}