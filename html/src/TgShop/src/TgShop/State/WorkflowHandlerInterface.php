<?php
declare(strict_types=1);

namespace TgShop\State;

use TgShop\Middleware\MiddlewareInterface;

interface WorkflowHandlerInterface extends MiddlewareInterface
{
    public function setStep(string $stepName): void;

    public function setParameters(array $parameters): void;
}