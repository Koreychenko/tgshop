<?php
declare(strict_types=1);

namespace App\Bot\StoreBot\Service;

use Psr\Container\ContainerInterface;
use TgShop\Transport\ImmediateSender;

final class SetWebhookServiceFactory
{
    public function __invoke(ContainerInterface $container): SetWebhookService
    {
        return new SetWebhookService(
            $container->get('config')['host'],
            $container->get(ImmediateSender::class)
        );
    }
}