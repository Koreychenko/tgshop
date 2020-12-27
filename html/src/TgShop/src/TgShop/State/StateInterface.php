<?php
declare(strict_types=1);

namespace TgShop\State;

interface StateInterface
{
    public function getHandler(): string;

    public function getStep(): string;

    public function getParameters(): array;
}