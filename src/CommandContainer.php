<?php

namespace PhpSquad;

use Exception;
use ReflectionClass;
use ReflectionException;

class CommandContainer
{
    public array $bindings = [];

    public function bind($abstract, callable $concrete)
    {
        $this->bindings[$abstract] = $concrete;
    }

    public function make($abstract)
    {
        try {
            if (isset($this->bindings[$abstract])){
                return $this->bindings[$abstract];
            }

            $reflection = new ReflectionClass($abstract);

            $dependencies = $this->buildDependencies($reflection);

            return $reflection->newInstanceArgs($dependencies);

        }catch (Exception $exception){
            throw new ReflectionException('Could not resolve class Dependencies for '.': ' . $abstract);
        }

    }

    private function buildDependencies(ReflectionClass $reflection)
    {
        $constructor = $reflection->getConstructor();

        if (!$constructor) {
            return [];
        }

        $constructor = $reflection->getConstructor();

        $params = $constructor->getParameters();


        return array_map(function ($param) {

            $className = $param->getClass();

            if (!$className) {
               return $this->getDefaultValue($param);
            }

            $className = $param->getClass()->getName();

            return $this->make($className);
        }, $params);
    }

    private function getDefaultValue(\ReflectionParameter $param)
    {
        if($param->isDefaultValueAvailable()){
            return $param->getDefaultValue();
        }
        throw new Exception('no default value');
    }
}