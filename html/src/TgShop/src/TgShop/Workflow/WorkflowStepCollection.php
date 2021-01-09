<?php
declare(strict_types=1);

namespace TgShop\Workflow;

use Exception;

class WorkflowStepCollection
{
    private array $steps;

    public function __construct(array $steps)
    {
        foreach ($steps as $stepName => $step) {
            if (!(is_string($stepName) && ($step instanceof WorkflowStepInterface))) {
                throw new Exception(
                    'You should provide workflow steps as an array of step names as keys and workflow steps as values'
                );
            }

            $this->steps[$stepName] = $step;
        }
    }

    public function getFirstStepName(): ?string
    {
        return array_key_first($this->steps);
    }

    public function getNextStepName(string $stepName): ?string
    {
        $steps = array_keys($this->steps);

        $position = array_search($stepName, $this->steps);

        if (array_key_exists($position + 1, $steps)) {
            return $steps[$position + 1];
        }

        return null;
    }

    public function getStep(string $stepName): WorkflowStepInterface
    {
        if (!array_key_exists($stepName, $this->steps)) {
            throw new Exception(
                sprintf('Invalid step name >>%s<<', $stepName)
            );
        }

        return $this->steps[$stepName];
    }
}