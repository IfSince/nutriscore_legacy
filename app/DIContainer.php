<?php

namespace NutriScore;

use ReflectionClass;

class DIContainer {
    private array $services = [];

    public function set($name, $service): void {
        $this->services[$name] = $service;
    }

    public function get($name, array $params = []): mixed {
        if (!isset($this->services[$name])) {
            $this->services[$name] = $this->autowire($name, $params);
        }

        return $this->services[$name];
    }

    public function autowire($className, $args = []) {
        $reflectionClass = new ReflectionClass($className);

        if (!$reflectionClass->getConstructor()) {
            return new $className();
        }

        $constructorParams = $reflectionClass->getConstructor()->getParameters();
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