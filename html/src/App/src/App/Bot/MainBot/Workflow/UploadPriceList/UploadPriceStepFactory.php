<?php

declare(strict_types=1);

namespace App\Bot\MainBot\Workflow\UploadPriceList;

use Psr\Container\ContainerInterface;
use TgShop\Service\DownloadFileService;

final class UploadPriceStepFactory
{
    public function __invoke(ContainerInterface $container): UploadPriceStep
    {
        return new UploadPriceStep($container->get(DownloadFileService::class));
    }
}