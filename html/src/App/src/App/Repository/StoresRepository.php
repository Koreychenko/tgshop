<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Store;
use Doctrine\ORM\EntityRepository;

class StoresRepository extends EntityRepository implements StoresRepositoryInterface
{
    public function getStoreByToken(string $token): ?Store
    {
        return null;
    }
}