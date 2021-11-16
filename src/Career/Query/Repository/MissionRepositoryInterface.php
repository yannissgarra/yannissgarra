<?php

declare(strict_types=1);

namespace App\Career\Query\Repository;

use App\Common\Query\Repository\RepositoryInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;

interface MissionRepositoryInterface extends RepositoryInterface
{
    public function populateActivities(Collection $activities, Uuid $languageId): void;
}
