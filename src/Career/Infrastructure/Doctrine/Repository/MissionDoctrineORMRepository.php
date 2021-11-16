<?php

declare(strict_types=1);

namespace App\Career\Infrastructure\Doctrine\Repository;

use App\Career\Domain\Model\Mission;
use App\Career\Domain\Repository\MissionRepositoryInterface;
use App\Common\Infrastructure\Doctrine\Repository\AbstractDoctrineORMRepository;
use Doctrine\Persistence\ManagerRegistry;

final class MissionDoctrineORMRepository extends AbstractDoctrineORMRepository implements MissionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mission::class);
    }
}
