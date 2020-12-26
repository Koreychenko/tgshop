<?php
declare(strict_types=1);

namespace App\Service;

use TgShop\StaticBotProviderInterface;
use TgShop\Service\ImmediateSender;

class MainStaticBotProvider implements StaticBotProviderInterface
{
    protected string $token;

    protected ImmediateSender $bot;

    public function __construct(string $token, ImmediateSender $bot)
    {
        $this->token = $token;
        $this->bot   = $bot;
    }

    public function getBot(?string $botId = null): ?ImmediateSender
    {
        $this->bot->setToken($this->token);

        return $this->bot;
    }
}