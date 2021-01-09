<?php
declare(strict_types=1);

namespace TgShop\State;

interface StateInterface
{
    public function getWorkflow(): string;

    public function getStep(): string;

    public function getParameters(): ?object;

    public function setStep(string $stepName): void;

    public function setWorkflow(string $stepName): void;

    public function setParameters(object $parameters): void;
}