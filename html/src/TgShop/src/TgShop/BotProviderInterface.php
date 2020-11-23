<?php
declare(strict_types=1);

namespace TgShop;

use TgShop\Service\Bot;

interface BotProviderInterface
{
    public function getBot(string $botId): ?Bot;
}