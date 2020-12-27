<?php
declare(strict_types=1);

namespace TgShop\Router\Matcher;

use Psr\Container\ContainerInterface;
use TgShop\State\StateRepositoryInterface;

final class StateMatcherFactory
{
    public function __invoke(ContainerInterface $container): StateMatcher
    {
        $stateRepository = $container->get(StateRepositoryInterface::class);

        return new StateMatcher($stateRepository);
    }
}