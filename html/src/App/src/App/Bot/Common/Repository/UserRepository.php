<?php
declare(strict_types=1);

namespace App\Bot\Common\Repository;

use App\Entity\User as DatabaseUser;
use Doctrine\ORM\EntityRepository;
use TgShop\Dto\User;

class UserRepository extends EntityRepository implements UserRepositoryInterface
{
    public function getOrCreateUser(User $user): DatabaseUser
    {
        $databaseUser = $this->findOneBy([
                                     'telegramId' => $user->getId(),
                                 ]);

        if (!$databaseUser) {
            $databaseUser = new DatabaseUser();
            $databaseUser->setBot($user->isBot());
            $databaseUser->setFirstName($user->getFirstName());
            $databaseUser->setLastName($user->getLastName());
            $databaseUser->setUserName($user->getUserName());
            $databaseUser->setTelegramId($user->getId());
            $databaseUser->setLanguageCode($user->getLanguageCode());
            $databaseUser->setCanJoinGroups($user->getCanJoinGroups());
            $databaseUser->setCanReadAllGroupMessages($user->getCanReadAllGroupMessages());
            $databaseUser->setSupportsInlineQueries($user->getSupportsInlineQueries());
        }

        return $databaseUser;
    }
}