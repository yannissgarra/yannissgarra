<?php

declare(strict_types=1);

namespace App\Career\Infrastructure\Doctrine\Repository;

use App\Career\Domain\Model\ActivityTranslation;
use App\Career\Domain\Repository\ActivityTranslationRepositoryInterface;
use App\Common\Infrastructure\Doctrine\Repository\AbstractDoctrineORMRepository;
use Doctrine\Persistence\ManagerRegistry;

final class ActivityTranslationDoctrineORMRepository extends AbstractDoctrineORMRepository implements ActivityTranslationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActivityTranslation::class);
    }
}
