<?php

declare(strict_types=1);

namespace App\Language\Infrastructure\Doctrine\Repository;

use App\Common\Infrastructure\Doctrine\Repository\AbstractDoctrineORMRepository;
use App\Language\Domain\Model\Language;
use App\Language\Domain\Repository\LanguageRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

final class LanguageDoctrineORMRepository extends AbstractDoctrineORMRepository implements LanguageRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Language::class);
    }
}
