<?php

declare(strict_types=1);

namespace App\Bot\MainBot\Workflow\UploadPriceList;

use Psr\Container\ContainerInterface;
use TgShop\State\StateRepositoryInterface;
use TgShop\Workflow\WorkflowHandler;
use TgShop\Workflow\WorkflowStepCollection;

class UploadPriceWorkflowFactory
{
    public const SERVICE_NAME = 'upload_price_workflow';

    public function __invoke(ContainerInterface $container): WorkflowHandler
    {
        $steps = [
            UploadPriceStep::class => $container->get(UploadPriceStep::class),
        ];

        return new WorkflowHandler(
            self::SERVICE_NAME,
            new WorkflowStepCollection($steps),
            $container->get(StateRepositoryInterface::class)
        );
    }
}
