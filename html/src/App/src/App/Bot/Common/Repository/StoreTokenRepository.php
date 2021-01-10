<?php
declare(strict_types=1);

namespace App\Bot\Common\Repository;

use App\Entity\Store;
use App\Entity\StoreToken;
use Doctrine\ORM\EntityRepository;

class StoreTokenRepository extends EntityRepository implements StoreTokenRepositoryInterface
{
    public function addStoreToken(int $storeId, string $botToken, string $accessToken)
    {
        $storeToken = new StoreToken();
        $storeToken->setStore($this->_em->getReference(Store::class, $storeId));
        $storeToken->setBotToken($botToken);
        $storeToken->setAccessToken($accessToken);

        $this->_em->persist($storeToken);
    }
}