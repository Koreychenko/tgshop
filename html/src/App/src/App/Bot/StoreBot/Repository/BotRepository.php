<?php
declare(strict_types=1);

namespace App\Bot\StoreBot\Repository;

use App\Entity\StoreToken;

class BotRepository implements BotRepositoryInterface
{
    public function getStoreTokenByAccessToken(string $id): ?StoreToken
    {
        return null;
    }
}