<?php

declare(strict_types=1);

namespace App\Career\Infrastructure\Twig;

use App\Career\Query\Model\EmployeeFull;
use App\Career\Query\Repository\EmployeeRepositoryInterface;
use Symfony\Component\Uid\Uuid;
use Twig\Extension\RuntimeExtensionInterface;

final class EmployeeRuntime implements RuntimeExtensionInterface
{
    private EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function findEmployee(): EmployeeFull
    {
        return $this->employeeRepository->findOne(Uuid::fromString('ffe7d61f-f184-44a7-bce7-256e6cd8e7a3'), Uuid::fromString('f0d0c1c9-a1f0-4057-a7f6-78e2673e4829'));
    }
}
