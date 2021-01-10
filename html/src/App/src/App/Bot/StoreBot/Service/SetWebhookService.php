<?php
declare(strict_types=1);

namespace App\Bot\StoreBot\Service;

use App\Entity\StoreToken;
use TgShop\Command\DeleteWebhook;
use TgShop\Command\SetWebhook;
use TgShop\Model\Bot;
use TgShop\Model\CommandCollection;
use TgShop\Model\CommandCollectionItem;
use TgShop\Transport\SenderInterface;

class SetWebhookService
{
    protected string          $host;

    protected SenderInterface $sender;

    public function __construct(string $host, SenderInterface $sender)
    {
        $this->host   = $host;
        $this->sender = $sender;
    }

    public function set(StoreToken $storeToken)
    {
        $bot = new Bot($storeToken->getAccessToken(), $storeToken->getBotToken());

        $commandCollection = new CommandCollection();
        $commandCollection->addCommand(new CommandCollectionItem(new DeleteWebhook(), $bot));
        $commandCollection->addCommand(new CommandCollectionItem(
                                           new SetWebhook($this->host . '/update/store/'
                                                          . $storeToken->getAccessToken()), $bot)
        );

        $this->sender->send($commandCollection);
    }
}