<?php

declare(strict_types=1);

namespace App\Career\Query\Repository;

use App\Common\Query\Repository\RepositoryInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;

interface ActivityRepositoryInterface extends RepositoryInterface
{
    public function findByTypes(array $types, Uuid $languageId): Collection;
}
