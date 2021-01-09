<?php
declare(strict_types=1);

namespace App\Bot\MainBot\Workflow\AddStore;

use Psr\Container\ContainerInterface;
use TgShop\State\StateRepositoryInterface;
use TgShop\Workflow\WorkflowHandler;
use TgShop\Workflow\WorkflowStepCollection;

final class AddStoreWorkflowFactory
{
    public const SERVICE_NAME = 'add_store_workflow';

    public function __invoke(ContainerInterface $container): WorkflowHandler
    {
        $steps = [
            AddStoreNameStep::class => $container->get(AddStoreNameStep::class),
        ];

        return new WorkflowHandler(
            self::SERVICE_NAME,
            new WorkflowStepCollection($steps),
            $container->get(StateRepositoryInterface::class)
        );
    }
}