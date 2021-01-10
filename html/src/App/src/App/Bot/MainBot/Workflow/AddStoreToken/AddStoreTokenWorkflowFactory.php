<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Workflow\AddStoreToken;

use Psr\Container\ContainerInterface;
use TgShop\State\StateRepositoryInterface;
use TgShop\Workflow\WorkflowHandler;
use TgShop\Workflow\WorkflowStepCollection;

final class AddStoreTokenWorkflowFactory
{
    public const SERVICE_NAME = 'add_store_token_workflow';

    public function __invoke(ContainerInterface $container): WorkflowHandler
    {
        $steps = [
            AddStoreTokenStep::class => $container->get(AddStoreTokenStep::class),
        ];

        return new WorkflowHandler(
            self::SERVICE_NAME,
            new WorkflowStepCollection($steps),
            $container->get(StateRepositoryInterface::class)
        );
    }
}