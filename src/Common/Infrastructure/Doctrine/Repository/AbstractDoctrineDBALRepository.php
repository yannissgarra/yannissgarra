<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Doctrine\Repository;

use App\Common\Query\Repository\RepositoryInterface;
use Doctrine\DBAL\Query\QueryBuilder;

abstract class AbstractDoctrineDBALRepository implements EntityManagerAwareInterface, RepositoryInterface
{
    use EntityManagerAwareTrait;

    protected function createQueryBuilder(): QueryBuilder
    {
        return $this->entityManager->getConnection()->createQueryBuilder();
    }
}
