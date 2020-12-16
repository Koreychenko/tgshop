<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Store;
use Doctrine\Persistence\ObjectRepository;

interface StoresRepositoryInterface extends ObjectRepository
{
    public function getStoreByToken(string $token): ?Store;
}