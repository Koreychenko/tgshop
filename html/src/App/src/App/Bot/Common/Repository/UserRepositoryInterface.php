<?php
declare(strict_types=1);

namespace App\Bot\Common\Repository;

use App\Entity\User as DatabaseUser;
use Doctrine\Persistence\ObjectRepository;
use TgShop\Dto\User;

interface UserRepositoryInterface extends ObjectRepository
{
    public function getOrCreateUser(User $user): DatabaseUser;
}