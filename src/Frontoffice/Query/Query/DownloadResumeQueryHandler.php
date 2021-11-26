<?php

declare(strict_types=1);

namespace App\Frontoffice\Query\Query;

use App\Career\Query\Repository\EmployeeRepositoryInterface;
use Webmunkeez\CQRSBundle\Query\QueryHandlerInterface;

final class DownloadResumeQueryHandler implements QueryHandlerInterface
{
    private EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function __invoke(DownloadResumeQuery $query): array
    {
        return [
            'employee' => $this->employeeRepository->findOne($query->getEmployeeId(), $query->getLanguageId()),
        ];
    }
}
