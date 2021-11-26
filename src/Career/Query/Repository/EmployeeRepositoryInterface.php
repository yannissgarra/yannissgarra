<?php

declare(strict_types=1);

namespace App\Career\Query\Repository;

use App\Career\Query\Model\EmployeeFull;
use Symfony\Component\Uid\Uuid;
use Webmunkeez\CQRSDoctrineBundle\Repository\ReadRepositoryInterface;

interface EmployeeRepositoryInterface extends ReadRepositoryInterface
{
    public function findOne(Uuid $id, Uuid $languageId): EmployeeFull;
}
