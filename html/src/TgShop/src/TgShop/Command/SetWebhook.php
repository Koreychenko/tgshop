<?php
declare(strict_types=1);

namespace TgShop\Command;

class SetWebhook extends Command implements CommandInterface
{
    protected static string $uri = 'setWebhook';

    protected string  $url;

    protected ?string $certificate    = null;

    protected ?string $ipAddress      = null;

    protected ?int    $maxConnections = null;

    protected ?array  $allowedUpdates = null;

    public function __construct(
        string $url
    ) {
        $this->url = $url;
    }

    public function setCertificate(string $certificate): self
    {
        $this->certificate = $certificate;

        return $this;
    }

    public function setIpAddress(string $ipAddress): self
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    public function setMaxConnections(int $maxConnections): self
    {
        $this->maxConnections = $maxConnections;

        return $this;
    }

    public function setAllowedUpdates(array $allowedUpdates): self
    {
        $this->allowedUpdates = $allowedUpdates;

        return $this;
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