<?php

declare(strict_types=1);

namespace App\Career\Infrastructure\Doctrine\Repository;

use App\Career\Domain\Model\MissionTranslation;
use App\Career\Domain\Repository\MissionTranslationRepositoryInterface;
use App\Common\Infrastructure\Doctrine\Repository\AbstractDoctrineORMRepository;
use Doctrine\Persistence\ManagerRegistry;

final class MissionTranslationDoctrineORMRepository extends AbstractDoctrineORMRepository implements MissionTranslationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MissionTranslation::class);
    }
}
