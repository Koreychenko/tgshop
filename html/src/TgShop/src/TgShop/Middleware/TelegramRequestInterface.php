<?php
declare(strict_types=1);

namespace TgShop\Middleware;

use TgShop\Dto\Update;

interface TelegramRequestInterface
{
    public function getArgument(string $argumentName);

    public function getParameter(string $parameterName);

    public function getUpdate(): Update;

    public function setArgument(string $argumentName, $argument);
}