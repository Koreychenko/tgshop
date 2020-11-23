<?php
declare(strict_types=1);

namespace App;

use App\Aux\ConsoleApplicationFactory;
use App\Aux\LoggerFactory;
use App\Cli\MainBotRegisterWebhookCommandFactory;
use App\Handler\UpdateHandler;
use App\Handler\UpdateHandlerFactory;
use App\Middleware\CheckTokenMiddleware;
use App\Middleware\CheckTokenMiddlewareFactory;
use App\Service\MainBotProvider;
use App\Service\MainBotProviderFactory;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Application;
use TgShop\Cli\RegisterWebhookCommand;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    public function getDependencies() : array
    {
        return [
            'factories' => [
                UpdateHandler::class          => UpdateHandlerFactory::class,
                CheckTokenMiddleware::class   => CheckTokenMiddlewareFactory::class,
                LoggerInterface::class        => LoggerFactory::class,
                Application::class            => ConsoleApplicationFactory::class,
                RegisterWebhookCommand::class => MainBotRegisterWebhookCommandFactory::class,
                MainBotProvider::class        => MainBotProviderFactory::class,
            ],
            'cli' => [

            ]
        ];
    }
}