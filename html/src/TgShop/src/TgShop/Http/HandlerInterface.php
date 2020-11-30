<?php
declare(strict_types=1);

namespace TgShop\Http;

interface HandlerInterface
{
    public function handle(RequestInterface $request);
}