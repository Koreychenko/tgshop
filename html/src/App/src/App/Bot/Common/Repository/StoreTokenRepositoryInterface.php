<?php
declare(strict_types=1);

namespace App\Bot\Common\Repository;

use Doctrine\Persistence\ObjectRepository;

interface StoreTokenRepositoryInterface extends ObjectRepository
{
    public function addStoreToken(int $storeId, string $botToken, string $accessToken);
}