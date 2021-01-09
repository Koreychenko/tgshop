<?php
declare(strict_types=1);

namespace TgShop\State;

use TgShop\Dto\UserInterface;
use TgShop\Model\Bot;

interface StateRepositoryInterface
{
    public function createState(string $workflowName, string $stepName, UserInterface $user, Bot $bot): StateInterface;

    public function getState(UserInterface $user, Bot $bot): ?StateInterface;

    public function insert($entity);

    public function remove($state);
}