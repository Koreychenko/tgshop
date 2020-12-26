<?php
declare(strict_types=1);

namespace TgShop;

use TgShop\Model\Bot;

interface BotProviderInterface
{
    public function getBot(string $id): ?Bot;
}