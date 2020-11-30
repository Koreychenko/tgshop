<?php
declare(strict_types=1);

namespace TgShop\Http;

use TgShop\Dto\Update;

interface RequestInterface
{
    public function getUpdate(): Update;

    public function setArgument(string $argumentName, $argument);

    public function getArgument(string $parameterName);

    public function getParameter(string $parameterName);
}