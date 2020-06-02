<?php

namespace Unit;

use PhpSquad\App\Kernel;
use PHPUnit\Framework\TestCase;
use PhpSquad\App\Commands\SayHi;
use PhpSquad\App\CommandContainer;
use Symfony\Component\Console\Application;

class CommandContainerTest extends TestCase
{

    public function testSetup()
    {
        $container = new CommandContainer();
        $sayHi = $container->make(SayHi::class);
        $this->assertInstanceOf(SayHi::class, $sayHi);
    }

    public function testRegisterCommands()
    {
        $application = new Application();
        $container = new CommandContainer();
        $kernel = new Kernel($container);

        $commandsRegistered = $kernel->registerCommands($application);

        $this->assertTrue($commandsRegistered);
    }

    public function testCommand()
    {
        $result = exec('php commando say:hi');

        $this->assertEquals('The Say Hello Class is Registered and Working!!!!', $result);
    }

}