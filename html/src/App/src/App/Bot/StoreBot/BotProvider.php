<?php
declare(strict_types=1);

namespace App\Bot\StoreBot;

use App\Bot\StoreBot\Repository\BotRepositoryInterface;
use TgShop\BotProviderInterface;
use TgShop\Model\Bot;

class BotProvider implements BotProviderInterface
{
    private BotRepositoryInterface $botRepository;

    public function __construct(BotRepositoryInterface $botRepository)
    {
        $this->botRepository = $botRepository;
    }

    public function getBot(string $id): ?Bot
    {
        $bot = $this->botRepository->getStoreTokenByAccessToken($id);

        if (!$bot) {
            return null;
        }

        return new Bot($id, $bot->getBotToken());
    }
}