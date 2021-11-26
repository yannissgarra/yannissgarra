<?php

declare(strict_types=1);

namespace App\Career\Query\Repository;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;
use Webmunkeez\CQRSDoctrineBundle\Repository\ReadRepositoryInterface;

interface ActivityRepositoryInterface extends ReadRepositoryInterface
{
    public function findByEmployee(Uuid $employeeId, Uuid $languageId): Collection;
}
