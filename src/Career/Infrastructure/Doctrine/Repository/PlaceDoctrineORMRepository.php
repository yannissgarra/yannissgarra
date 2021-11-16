<?php

declare(strict_types=1);

namespace App\Career\Infrastructure\Doctrine\Repository;

use App\Career\Domain\Model\Place;
use App\Career\Domain\Repository\PlaceRepositoryInterface;
use App\Common\Infrastructure\Doctrine\Repository\AbstractDoctrineORMRepository;
use Doctrine\Persistence\ManagerRegistry;

final class PlaceDoctrineORMRepository extends AbstractDoctrineORMRepository implements PlaceRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Place::class);
    }
}
