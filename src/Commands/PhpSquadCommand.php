<?php

namespace PhpSquad\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

class PhpSquadCommand extends command
{
    public  function info($message, OutputInterface $output)
    {
        return $output->writeln("<info>hello<info>");
    }
}