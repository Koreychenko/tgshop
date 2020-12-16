<?php
declare(strict_types=1);

namespace App\Service;

use TgShop\StaticBotProviderInterface;
use TgShop\Service\Bot;

class MainStaticBotProvider implements StaticBotProviderInterface
{
    protected string $token;

    protected Bot    $bot;

    public function __construct(string $token, Bot $bot)
    {
        $this->token = $token;
        $this->bot   = $bot;
    }

    public function getBot(?string $botId = null): ?Bot
    {
        $this->bot->setToken($this->token);

        return $this->bot;
    }
}