<?php

namespace Unit;

use PhpSquad\CommandContainer;
use PhpSquad\Commands\Commando\SayHi;
use PhpSquad\kernel;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;

class CommandContainerTest extends TestCase
{

    public function testSetup()
    {
        $container = new CommandContainer();
        $sayHi = $container->make(SayHi::class);
        $this->assertInstanceOf(SayHi::class, $sayHi);

        $this->assertTrue(true);
    }

    public function testRegisterCommands()
    {
        $application = new Application();
        $kernel = new kernel();
        $commandsRegistered = $kernel->registerCommands($application);

        $this->assertTrue($commandsRegistered);
    }
}