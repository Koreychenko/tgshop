<?php
declare(strict_types=1);

namespace TgShop\State;

interface StateInterface
{
    public function getWorkflow(): string;

    public function getStep(): string;

    public function getParameters(): ?array;

    public function setStep(string $stepName): void;

    public function setWorkflow(string $stepName): void;

    public function setParameters(array $parameters): void;

    public function addParameter(string $name, $value): void;

    public function getParameter(string $name);
}