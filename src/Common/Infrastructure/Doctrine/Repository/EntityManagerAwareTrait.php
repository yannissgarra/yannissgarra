<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;

trait EntityManagerAwareTrait
{
    protected EntityManagerInterface $entityManager;

    public function setEntityManager(EntityManagerInterface $entityManager): void
    {
        $this->entityManager = $entityManager;
    }
}
