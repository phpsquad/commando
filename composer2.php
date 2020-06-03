<?php

namespace PhpSquad\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreatePackage extends Command
{
    protected static $defaultName = 'make:package';

    protected function configure()
    {
        $this->setDescription('Create a boilerplate package')->setHelp('create a package');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
       // write the command logic here
        $this->creatDirectories();

        return 0;
    }

    protected function creatDirectories()
    {
        $folder_full = "./src/services";
        if (!is_dir($folder_full)) mkdir($folder_full, 0777, true);

        $folder_full = "./src/repositories";
        if (!is_dir($folder_full)) mkdir($folder_full, 0777, true);

        $folder_full = "./tests/Unit";
        if (!is_dir($folder_full)) mkdir($folder_full, 0777, true);

        $folder_full = "./tests/Integration";
        if (!is_dir($folder_full)) mkdir($folder_full, 0777, true);

        $folder_full = "./.github/workflows/unittest.yml";
        if (!is_dir($folder_full)) mkdir($folder_full, 0777, true);

        copy(dirname(__FILE__.'/stubs/composer.stub', 2), './composer2.php');
    }
}