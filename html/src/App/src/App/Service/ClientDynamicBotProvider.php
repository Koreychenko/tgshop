<?php
declare(strict_types=1);

namespace App\Service;

use App\Middleware\ExtractStoreParametersMiddleware;
use Psr\Http\Message\ServerRequestInterface;
use TgShop\DynamicBotProviderInterface;
use TgShop\Service\Bot;

class ClientDynamicBotProvider implements DynamicBotProviderInterface
{
    protected Bot $bot;

    public function __construct(Bot $bot)
    {
        $this->bot = $bot;
    }

    public function getBotByRequest(ServerRequestInterface $request): ?Bot
    {
        $storeToken = $request->getAttribute(ExtractStoreParametersMiddleware::ARGUMENT_STORE_TOKEN);

        if (!$storeToken) {
            return null;
        }

        $this->bot->setToken($storeToken->getBotToken());
    }
}