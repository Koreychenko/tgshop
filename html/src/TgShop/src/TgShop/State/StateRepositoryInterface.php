<?php
declare(strict_types=1);

namespace TgShop\State;

interface StateRepositoryInterface
{
    public function getState($user, $bot): ?StateInterface;
}