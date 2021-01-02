<?php
declare(strict_types=1);

namespace App\Bot\StoreBot\Repository;

use App\Entity\StoreToken;

interface BotRepositoryInterface
{
    public function getStoreTokenByAccessToken(string $id): ?StoreToken;
}