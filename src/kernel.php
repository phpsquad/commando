<?php

namespace PhpSquad;

class kernel
{
    public function registerCommands($application)
    {
        $application->setName('PhpSquad Commando');

        $this->registerForemanCommands($application);

        if ($handle = opendir(__DIR__.'/Commands')) {

            $classes = [];
            while (false !== ($entry = readdir($handle))) {

                $fileExt = pathinfo($entry, PATHINFO_EXTENSION);

                if ($fileExt != 'php'){
                    continue;
                }

                if ($entry != "." && $entry != "..") {
                    $class = preg_replace('/\\.[^.\\s]{3,4}$/', '', $entry);
                    $classes[$class] = 'PhpSquad\\Commands\\'."$class";
                }
            }

            foreach ($classes as $command){
                $container = new CommandContainer();
                $command = $container->make($command);
                $application->add($command);
            }
            closedir($handle);
        }

        return true;
    }

    public function registerForemanCommands($application)
    {

        if ($handle = opendir(__DIR__.'/Commands/Commando')) {

            $classes = [];
            while (false !== ($entry = readdir($handle))) {

                $fileExt = pathinfo($entry, PATHINFO_EXTENSION);

                if ($fileExt != 'php'){
                    continue;
                }

                if ($entry != "." && $entry != "..") {
                    $class = preg_replace('/\\.[^.\\s]{3,4}$/', '', $entry);
                    $classes[$class] = 'PhpSquad\\Commands\\Commando\\'."$class";
                }
            }

            foreach ($classes as $command){
                $container = new CommandContainer();
                $command = $container->make($command);
                $application->add($command);
            }
            closedir($handle);
        }
    }
}