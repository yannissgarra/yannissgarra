<?php

declare(strict_types=1);

namespace App\Career\Infrastructure\Doctrine\Repository;

use App\Career\Domain\Model\PlaceTranslation;
use App\Career\Domain\Repository\PlaceTranslationRepositoryInterface;
use App\Common\Infrastructure\Doctrine\Repository\AbstractDoctrineORMRepository;
use Doctrine\Persistence\ManagerRegistry;

final class PlaceTranslationDoctrineORMRepository extends AbstractDoctrineORMRepository implements PlaceTranslationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaceTranslation::class);
    }
}
