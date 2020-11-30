<?php
declare(strict_types=1);

namespace TgShop\Http;

interface MiddlewareInterface
{
    public function process(RequestInterface $request);
}