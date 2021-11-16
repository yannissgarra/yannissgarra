<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;

interface EntityManagerAwareInterface
{
    public function setEntityManager(EntityManagerInterface $entityManager): void;
}
