<?php
declare(strict_types=1);

namespace App\Bot\MainBot;

use TgShop\BotProviderInterface;
use TgShop\Model\Bot;

class BotProvider implements BotProviderInterface
{
    public const MAIN_BOT_TITLE = 'main_bot';

    protected string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function getBot(?string $id = null): ?Bot
    {
        return new Bot(static::MAIN_BOT_TITLE, $this->token);
    }
}