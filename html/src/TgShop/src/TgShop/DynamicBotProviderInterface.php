<?php
declare(strict_types=1);

namespace TgShop;

use Psr\Http\Message\ServerRequestInterface;
use TgShop\Service\Bot;

interface DynamicBotProviderInterface
{
    public function getBotByRequest(ServerRequestInterface $request): ?Bot;
}