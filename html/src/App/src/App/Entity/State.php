<?php
declare(strict_types=1);

namespace App\Entity;

use TgShop\State\StateInterface;

class State implements StateInterface
{
    private int $id;

    private int $userId;

    private User $user;

    private string $botId;

    private string $step;

    private string $workflow;

    private ?array $parameters;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getBotId(): string
    {
        return $this->botId;
    }

    public function setBotId(string $botId): void
    {
        $this->botId = $botId;
    }

    public function getStep(): string
    {
        return $this->step;
    }

    public function setStep(string $step): void
    {
        $this->step = $step;
    }

    public function getWorkflow(): string
    {
        return $this->workflow;
    }

    public function setWorkflow(string $workflow): void
    {
        $this->workflow = $workflow;
    }

    public function getParameters(): ?array
    {
        return $this->parameters;
    }

    public function setParameters(array $parameters): void
    {
        $this->parameters = $parameters;
    }

    public function addParameter(string $name, $value): void
    {
        $this->parameters[$name] = $value;
    }

    public function getParameter(string $name)
    {
        if (!array_key_exists($name, $this->parameters)) {
            return null;
        }

        return $this->parameters[$name];
    }
}