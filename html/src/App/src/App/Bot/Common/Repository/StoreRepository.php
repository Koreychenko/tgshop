<?php
declare(strict_types=1);

namespace App\Bot\Common\Repository;

use App\Entity\Store;
use DateTime;
use Doctrine\ORM\EntityRepository;
use TgShop\Dto\UserInterface;

class StoreRepository extends EntityRepository implements StoreRepositoryInterface
{
    public function createStore(string $storeName, UserInterface $user)
    {
        $currentDate = new DateTime();

        $store = new Store();
        $store->setName($storeName);
        $store->setOwner($user);
        $store->setCreatedAt($currentDate);
        $store->setUpdatedAt($currentDate);

        $this->_em->persist($store);
    }

    public function getStoreByName(string $storeName, UserInterface $user)
    {
        return $this->findBy(
            [
                'name'    => $storeName,
                'ownerId' => $user->getId(),
            ]
        );
    }

    public function remove($store): void
    {
        $this->_em->remove($store);
    }

    public function insert($store): void
    {
        $this->_em->persist($store);
    }
}