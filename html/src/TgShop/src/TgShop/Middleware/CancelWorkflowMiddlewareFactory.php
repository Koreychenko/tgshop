<?php
declare(strict_types=1);

namespace TgShop\Middleware;

use Psr\Container\ContainerInterface;
use TgShop\State\StateRepositoryInterface;

final class CancelWorkflowMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): CancelWorkflowMiddleware
    {
        return new CancelWorkflowMiddleware(
            $container->get(StateRepositoryInterface::class)
        );
    }
}