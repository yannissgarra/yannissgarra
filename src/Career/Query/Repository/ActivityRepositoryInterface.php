<?php

declare(strict_types=1);

namespace App\Career\Query\Repository;

use App\Career\Query\Model\ActivityFull;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;
use Webmunkeez\CQRSDoctrineBundle\Repository\ReadRepositoryInterface;

interface ActivityRepositoryInterface extends ReadRepositoryInterface
{
    /**
     * @return ActivityFull[]
     */
    public function findByEmployee(Uuid $employeeId, Uuid $languageId): Collection;
}
