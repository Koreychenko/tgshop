<?php
declare(strict_types=1);

namespace TgShop\Handler;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DynamicBotUpdateHandler extends BotUpdateHandler implements RequestHandlerInterface
{
    public const ATTRIBUTE_TOKEN = 'token';

    public function getBotId(ServerRequestInterface $request = null): string
    {
        return $request->getAttribute(static::ATTRIBUTE_TOKEN);
    }
}