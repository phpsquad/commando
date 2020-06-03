<?php

namespace PhpSquad\App;

use Exception;
use ReflectionClass;
use ReflectionException;

if(file_exists(__DIR__.'/vendor/autoload.php')){
    require __DIR__.'/vendor/autoload.php';
}

if (file_exists(dirname(__FILE__, 3)  .'/autoload.php')){
    require dirname(__FILE__, 3)  .'/autoload.php';
}
if (file_exists(dirname(__FILE__, 6).'/src/Commands')){
    foreach (scandir(dirname(__FILE__, 6)  .'/src/Commands') as $filename) {
        $path = dirname(__FILE__, 6)  .'/src/Commands' . '/' . $filename;
        if (is_file($path)) {
            require $path;
        }
    }
}


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
            throw new ReflectionException('Could not resolve class Dependencies for '.': ' . $abstract . $exception->getMessage());
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