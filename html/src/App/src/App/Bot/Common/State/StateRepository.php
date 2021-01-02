<?php
declare(strict_types=1);

namespace App\Bot\Common\State;

use TgShop\State\StateInterface;
use TgShop\State\StateRepositoryInterface;

class StateRepository implements StateRepositoryInterface
{
    public function getState($user, $bot): ?StateInterface
    {
        // TODO: Implement getState() method.
    }
}