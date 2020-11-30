<?php
declare(strict_types=1);

namespace TgShop\Command;

class DeleteWebhook extends Command implements CommandInterface
{
    protected static string $uri = 'deleteWebhook';

    protected ?bool $dropPendingUpdates = null;

    public function setDropPendingUpdates(bool $dropPendingUpdates): self
    {
        $this->dropPendingUpdates = $dropPendingUpdates;

        return $this;
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