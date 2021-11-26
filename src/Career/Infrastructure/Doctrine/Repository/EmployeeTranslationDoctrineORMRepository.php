<?php

declare(strict_types=1);

namespace App\Career\Infrastructure\Doctrine\Repository;

use App\Career\Domain\Model\EmployeeTranslation;
use App\Career\Domain\Repository\EmployeeTranslationRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;
use Webmunkeez\CQRSDoctrineBundle\Doctrine\Repository\AbstractDoctrineORMRepository;

final class EmployeeTranslationDoctrineORMRepository extends AbstractDoctrineORMRepository implements EmployeeTranslationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmployeeTranslation::class);
    }
}
