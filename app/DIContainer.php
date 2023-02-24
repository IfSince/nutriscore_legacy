<?php

namespace NutriScore;

use ReflectionClass;

class DIContainer {
    private array $services = [];

    public function set(mixed $service): void {
        $this->services[$service::class] = $service;
    }

    public function get(string $name, array $params = []): mixed {
        if (!isset($this->services[$name])) {
            $this->services[$name] = $this->autowire($name, $params);
        }

        return $this->services[$name];
    }

    public function autowire(string $className, array $args = []): mixed {
        $reflectionClass = new ReflectionClass($className);
        $reflectionConstructor = $reflectionClass->getConstructor();
        
        if (!$reflectionConstructor) {
            return new $className();
        }

        $constructorParams = $reflectionConstructor->getParameters();
        foreach ($constructorParams as $param) {
            $class = $param->getClass();
            if ($class !== null) {
                $args[] = $this->get($class->getName());
            }
        }

        // Erstellen Sie eine neue Instanz mit den aufgelösten Abhängigkeiten
        return $reflectionClass->newInstanceArgs($args);
    }
}