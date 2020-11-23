<?php
declare(strict_types=1);

namespace App\Service;

use TgShop\BotProviderInterface;
use TgShop\Service\Bot;

class MainBotProvider implements BotProviderInterface
{
    protected string $token;

    protected Bot    $bot;

    public function __construct(string $token, Bot $bot)
    {
        $this->token = $token;
        $this->bot   = $bot;
    }

    public function getBot(string $botId): ?Bot
    {
        $this->bot->setToken($this->token);

        return $this->bot;
    }
}