<?php
declare(strict_types=1);

namespace App;

use App\Aux\ConsoleApplicationFactory;
use App\Aux\LoggerFactory;
use App\Cli\MainBotSendMessageCommandFactory;
use App\Cli\MainBotSetWebhookCommandFactory;
use App\Handler\UpdateHandler;
use App\Handler\UpdateHandlerFactory;
use App\Middleware\CheckTokenMiddleware;
use App\Middleware\CheckTokenMiddlewareFactory;
use App\Processor\Handler\CallbackQueryHandler;
use App\Processor\Handler\HelloStringHandler;
use App\Processor\Handler\StartCommandHandler;
use App\Processor\Handler\StartCommandHandlerFactory;
use App\Service\MainBotProvider;
use App\Service\MainBotProviderFactory;
use App\Service\MainBotRouteConfigurationFactory;
use App\Service\MainBotRouterFactory;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Application;
use TgShop\Cli\SendMessageCommand;
use TgShop\Cli\SetWebhookCommand;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'invokables' => [
                HelloStringHandler::class,
                CallbackQueryHandler::class,
            ],
            'factories' => [
                UpdateHandler::class                           => UpdateHandlerFactory::class,
                CheckTokenMiddleware::class                    => CheckTokenMiddlewareFactory::class,
                LoggerInterface::class                         => LoggerFactory::class,
                Application::class                             => ConsoleApplicationFactory::class,
                SetWebhookCommand::class                       => MainBotSetWebhookCommandFactory::class,
                SendMessageCommand::class                      => MainBotSendMessageCommandFactory::class,
                MainBotProvider::class                         => MainBotProviderFactory::class,
                MainBotRouteConfigurationFactory::SERVICE_NAME => MainBotRouteConfigurationFactory::class,
                MainBotRouterFactory::SERVICE_NAME             => MainBotRouterFactory::class,
                StartCommandHandler::class                     => StartCommandHandlerFactory::class,
            ],
            'cli'       => [

            ],
        ];
    }
}