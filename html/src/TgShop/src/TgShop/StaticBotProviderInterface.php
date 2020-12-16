<?php
declare(strict_types=1);

namespace TgShop;

use TgShop\Service\Bot;

interface StaticBotProviderInterface
{
    public function getBot(?string $botId = null): ?Bot;
}