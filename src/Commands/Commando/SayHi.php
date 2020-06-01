<?php

namespace PhpSquad\Commands\Commando;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SayHi extends Command
{

    protected static $defaultName = 'say:hi';

    /**
     * SayHi constructor.
     */

    protected function configure()
    {
        $this->setDescription('Say Hello.')->setHelp('This command says hello');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // ...
        echo 'The Say Hello Class is Registered and Working!!!!';

        return 0;
    }
}