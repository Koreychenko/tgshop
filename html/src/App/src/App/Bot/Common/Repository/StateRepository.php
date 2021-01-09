<?php
declare(strict_types=1);

namespace App\Bot\Common\Repository;

use App\Entity\State;
use Doctrine\ORM\EntityRepository;
use TgShop\Dto\UserInterface;
use TgShop\Model\Bot;
use TgShop\State\StateInterface;
use TgShop\State\StateRepositoryInterface;

class StateRepository extends EntityRepository implements StateRepositoryInterface
{
    public function getState(UserInterface $user, Bot $bot): ?StateInterface
    {
        return $this->findOneBy(
            [
                'userId' => $user->getId(),
                'botId'  => $bot->getId(),
            ]
        );
    }

    public function createState(string $workflowName, string $stepName, UserInterface $user, Bot $bot): StateInterface
    {
        $state = new State();
        $state->setStep($stepName);
        $state->setWorkflow($workflowName);
        $state->setUser($user);
        $state->setBotId($bot->getId());

        $this->insert($state);

        return $state;
    }

    public function insert($entity)
    {
        $this->_em->persist($entity);
    }

    public function remove($state)
    {
        $this->_em->remove($state);
    }
}