<?php

namespace PhpSquad\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    protected static $defaultName = 'do:something';

    protected function configure()
    {
        $this->setDescription('example description.')->setHelp('example help sentence to explain command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
       // write the command logic here

        return 0;
    }
}