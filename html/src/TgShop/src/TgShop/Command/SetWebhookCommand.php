<?php
declare(strict_types=1);

namespace TgShop\Command;

class SetWebhookCommand extends Command implements CommandInterface
{
    protected static string $uri = 'setWebhook';

    protected string  $url;

    protected ?string $certificate    = null;

    protected ?string $ipAddress      = null;

    protected ?int    $maxConnections = null;

    protected ?array  $allowedUpdates = null;

    public function __construct(
        string $url,
        ?string $certificate = null,
        ?string $ipAddress = null,
        ?int $maxConnections = null,
        ?array $allowedUpdates = null
    ) {
        $this->url            = $url;
        $this->certificate    = $certificate;
        $this->ipAddress      = $ipAddress;
        $this->maxConnections = $maxConnections;
        $this->allowedUpdates = $allowedUpdates;
    }

    public function format(): array
    {
        $command = [
            'url' => $this->url,
        ];

        if ($this->certificate) {
            $command['certificate'] = $this->certificate;
        }

        if ($this->ipAddress) {
            $command['ip_address'] = $this->ipAddress;
        }

        if ($this->maxConnections) {
            $command['max_connections'] = $this->maxConnections;
        }

        if ($this->allowedUpdates) {
            $command['allowed_updates'] = $this->allowedUpdates;
        }

        return $command;
    }
}