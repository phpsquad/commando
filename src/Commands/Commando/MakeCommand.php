<?php

namespace PhpSquad\Commands\Commando;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeCommand extends Command
{
    protected static $defaultName = 'make:command';

    protected function configure()
    {
        $this->setDescription('Make Command.')->setHelp('example: php foreman make:command MyCommand');
        $this->addArgument('commandName');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $commandName = $input->getArgument('commandName');

        $file = file_exists("./src/Commands/$commandName.php");

        if ($file){
            $output->writeln("<error>$commandName already exists!</error>");
            die();
        }

        $this->createCommandFile($commandName, $output);

        return 0;
    }

    /**
     * @param $commandName
     * @param  OutputInterface  $output
     */
    protected function createCommandFile($commandName, OutputInterface $output): void
    {
        copy('./src/stubs/command.stub', "./src/Commands/$commandName.php");

        $str = file_get_contents("./src/Commands/$commandName.php");

        $str = str_replace('$DummyCommandName', $commandName, $str);

        file_put_contents("./src/Commands/$commandName.php", $str);

        $output->writeln("<info>$commandName is now available in the Commands directory</info>");
    }
}