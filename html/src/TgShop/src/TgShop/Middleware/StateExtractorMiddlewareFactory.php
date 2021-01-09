<?php
declare(strict_types=1);

namespace TgShop\Middleware;

use Psr\Container\ContainerInterface;
use TgShop\State\StateRepositoryInterface;

final class StateExtractorMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): StateExtractorMiddleware
    {
        $stateRepository = $container->get(StateRepositoryInterface::class);

        return new StateExtractorMiddleware($stateRepository);
    }
}