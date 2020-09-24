<?php

namespace PhpSquad\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckWebsiteUpStatus extends PhpSquadCommand
{
    protected static $defaultName = 'check:status';

    protected function configure()
    {
        $this->setDescription('example description.')->setHelp('example help sentence to explain command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
       $output->writeln("<info>hello<info>");
       $this->info('whatever', $output);
        return 0;
    }
}