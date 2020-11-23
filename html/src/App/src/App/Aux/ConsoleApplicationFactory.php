<?php
declare(strict_types=1);

namespace App\Aux;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

final class ConsoleApplicationFactory
{
    public function __invoke(ContainerInterface $container): Application
    {
        $application = new Application();

        $enabledCommands = $container->get('config')['enabled_commands'];

        foreach ($enabledCommands as $command) {
            $application->add($container->get($command));
        }

        return $application;
    }
}