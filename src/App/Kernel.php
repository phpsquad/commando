<?php

namespace PhpSquad\App;

class Kernel
{

    private CommandContainer $container;

    /**
     * Kernel constructor.
     * @param  CommandContainer  $container
     */
    public function __construct(CommandContainer $container)
    {
        $this->container = $container;
    }


    public function registerCommands($application)
    {
        $application->setName('PhpSquad Commando');

        $this->registerForemanCommands($application);
        $this->registerCommandsInAppMode($application);
        $this->registerCommandsInPackageMode($application);

        return true;
    }

    public function registerForemanCommands($application)
    {

        if ($handle = opendir(__DIR__.'/Commands')) {

            $classes = [];
            while (false !== ($entry = readdir($handle))) {

                $fileExt = pathinfo($entry, PATHINFO_EXTENSION);

                if ($fileExt != 'php'){
                    continue;
                }

                if ($entry != "." && $entry != "..") {
                    $class = preg_replace('/\\.[^.\\s]{3,4}$/', '', $entry);
                    $classes[$class] = 'PhpSquad\\App\\Commands\\'."$class";
                }
            }

            foreach ($classes as $command){
                $command = $this->container->make($command);
                $application->add($command);
            }
            closedir($handle);
        }
    }

    protected function registerCommandsInAppMode($application)
    {
        if (!file_exists(dirname(__FILE__, 2).'/Commands')) {
            return true;
        }

        if ($handle = opendir(dirname(__FILE__, 2).'/Commands')) {

            $classes = [];
            while (false !== ($entry = readdir($handle))) {

                $fileExt = pathinfo($entry, PATHINFO_EXTENSION);

                if ($fileExt != 'php') {
                    continue;
                }

                if ($entry != "." && $entry != "..") {
                    $class = preg_replace('/\\.[^.\\s]{3,4}$/', '', $entry);
                    $classes[$class] = 'PhpSquad\\Commands\\'."$class";
                }
            }

            foreach ($classes as $command) {
                $command = $this->container->make($command);
                $application->add($command);
            }
            closedir($handle);
        }

        return true;
    }

    protected function registerCommandsInPackageMode($application)
    {
        if (!file_exists(dirname(__FILE__, 6).'/src/Commands')) {
            return true;
        }

        if ($handle = opendir(dirname(__FILE__, 6).'/src/Commands')) {

            $classes = [];
            while (false !== ($entry = readdir($handle))) {

                $fileExt = pathinfo($entry, PATHINFO_EXTENSION);

                if ($fileExt != 'php') {
                    continue;
                }

                if ($entry != "." && $entry != "..") {
                    $class = preg_replace('/\\.[^.\\s]{3,4}$/', '', $entry);
                    $classes[$class] = 'PhpSquad\\Commands\\'."$class";
                }
            }

            foreach ($classes as $command) {
                $command = $this->container->make($command);
                $application->add($command);
            }
            closedir($handle);
        }

        return true;
    }
}