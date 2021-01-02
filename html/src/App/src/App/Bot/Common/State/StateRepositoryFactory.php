<?php
declare(strict_types=1);

namespace App\Bot\Common\State;

use Psr\Container\ContainerInterface;

final class StateRepositoryFactory
{
    public function __invoke(ContainerInterface $container): StateRepository
    {
        return new StateRepository();
    }
}