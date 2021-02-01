<?php
declare(strict_types=1);

namespace App\Bot\MainBot;

use App\Bot\MainBot\Cli\SendMessageCommandFactory;
use App\Bot\MainBot\Cli\SetWebhookCommandFactory;
use App\Bot\MainBot\Http\Handler\UpdateHandlerFactory;
use App\Bot\MainBot\Http\Middleware\CheckTokenMiddleware;
use App\Bot\MainBot\Http\Middleware\CheckTokenMiddlewareFactory;
use App\Bot\MainBot\Middleware\CallbackQuery\DeleteStoreMiddleware;
use App\Bot\MainBot\Middleware\CallbackQuery\DeleteStoreMiddlewareFactory;
use App\Bot\MainBot\Middleware\CallbackQuery\SettingsMenuMiddleware;
use App\Bot\MainBot\Middleware\CallbackQuery\StoreTokensList;
use App\Bot\MainBot\Middleware\CallbackQuery\StoreTokensListFactory;
use App\Bot\MainBot\Middleware\CallbackQuery\SwitchLanguageMiddleware;
use App\Bot\MainBot\Middleware\Command\StartCommand;
use App\Bot\MainBot\Middleware\MainKeyboardMiddleware;
use App\Bot\MainBot\Middleware\RouterMiddlewareFactory;
use App\Bot\MainBot\Middleware\String\SettingsMiddleware;
use App\Bot\MainBot\Middleware\String\StoresMiddleware;
use App\Bot\MainBot\Router\RouteConfigurationFactory;
use App\Bot\MainBot\Router\RouterFactory;
use App\Bot\MainBot\Workflow\AddStore\AddStoreNameStep;
use App\Bot\MainBot\Workflow\AddStore\AddStoreNameStepFactory;
use App\Bot\MainBot\Workflow\AddStore\AddStoreWorkflowFactory;
use App\Bot\MainBot\Workflow\AddStoreToken\AddStoreTokenStep;
use App\Bot\MainBot\Workflow\AddStoreToken\AddStoreTokenStepFactory;
use App\Bot\MainBot\Workflow\AddStoreToken\AddStoreTokenWorkflowFactory;
use App\Bot\MainBot\Workflow\UploadPriceList\UploadPriceStep;
use App\Bot\MainBot\Workflow\UploadPriceList\UploadPriceStepFactory;
use App\Bot\MainBot\Workflow\UploadPriceList\UploadPriceWorkflowFactory;
use TgShop\Cli\SendMessageCommand;
use TgShop\Cli\SetWebhookCommand;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies'     => $this->getDependencies(),
            'enabled_commands' => $this->getEnabledCliCommands(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'invokables' => [
                StartCommand::class,
                MainKeyboardMiddleware::class,
                SettingsMiddleware::class,
                SettingsMenuMiddleware::class,
                SwitchLanguageMiddleware::class,
                StoresMiddleware::class,
            ],
            'factories'  => [
                SetWebhookCommand::class                   => SetWebhookCommandFactory::class,
                SendMessageCommand::class                  => SendMessageCommandFactory::class,
                BotProvider::class                         => BotProviderFactory::class,
                BotAppFactory::SERVICE_NAME                => BotAppFactory::class,
                RouterFactory::SERVICE_NAME                => RouterFactory::class,
                RouteConfigurationFactory::SERVICE_NAME    => RouteConfigurationFactory::class,
                UpdateHandlerFactory::SERVICE_NAME         => UpdateHandlerFactory::class,
                CheckTokenMiddleware::class                => CheckTokenMiddlewareFactory::class,
                RouterMiddlewareFactory::SERVICE_NAME      => RouterMiddlewareFactory::class,
                AddStoreWorkflowFactory::SERVICE_NAME      => AddStoreWorkflowFactory::class,
                AddStoreNameStep::class                    => AddStoreNameStepFactory::class,
                DeleteStoreMiddleware::class               => DeleteStoreMiddlewareFactory::class,
                AddStoreTokenStep::class                   => AddStoreTokenStepFactory::class,
                AddStoreTokenWorkflowFactory::SERVICE_NAME => AddStoreTokenWorkflowFactory::class,
                StoreTokensList::class                     => StoreTokensListFactory::class,
                UploadPriceStep::class                     => UploadPriceStepFactory::class,
                UploadPriceWorkflowFactory::SERVICE_NAME   => UploadPriceWorkflowFactory::class,
            ],
            'cli'        => [
            ],
        ];
    }

    private function getEnabledCliCommands(): array
    {
        return [
            SetWebhookCommand::class,
            SendMessageCommand::class,
        ];
    }
}