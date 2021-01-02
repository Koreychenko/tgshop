<?php
declare(strict_types=1);

namespace App\Bot\StoreBot;

use App\Bot\StoreBot\Repository\BotRepository;
use Psr\Container\ContainerInterface;

final class BotProviderFactory
{
    public function __invoke(ContainerInterface $container): BotProvider
    {
        $botRepository = new BotRepository();

        return new BotProvider(
            $botRepository
        );
    }
}