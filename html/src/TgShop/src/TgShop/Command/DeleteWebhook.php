<?php
declare(strict_types=1);

namespace TgShop\Command;

class DeleteWebhook extends Command implements CommandInterface
{
    protected static string $uri = 'deleteWebhook';

    protected ?bool $dropPendingUpdates = null;

    public function __construct(
        ?bool $dropPendingUpdates = null
    ) {
        $this->dropPendingUpdates = $dropPendingUpdates;
    }

    public function format(): array
    {
        $command = [];

        if ($this->dropPendingUpdates) {
            $command['drop_pending_updates'] = $this->dropPendingUpdates;
        }

        return $command;
    }
}