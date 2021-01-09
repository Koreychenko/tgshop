<?php
declare(strict_types=1);

namespace App\Bot\Common\Repository;

use Doctrine\Persistence\ObjectRepository;
use TgShop\Dto\UserInterface;

interface StoreRepositoryInterface extends ObjectRepository
{
    public function createStore(string $storeName, UserInterface $user);

    public function getStoreByName(string $storeName, UserInterface $user);

    public function remove($store): void;

    public function insert($store): void;
}