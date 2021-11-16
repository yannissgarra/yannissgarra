<?php

declare(strict_types=1);

namespace App\Career\Infrastructure\Doctrine\Repository;

use App\Career\Domain\Model\Activity;
use App\Career\Domain\Repository\ActivityRepositoryInterface;
use App\Common\Infrastructure\Doctrine\Repository\AbstractDoctrineORMRepository;
use Doctrine\Persistence\ManagerRegistry;

final class ActivityDoctrineORMRepository extends AbstractDoctrineORMRepository implements ActivityRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activity::class);
    }
}
