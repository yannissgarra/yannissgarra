<?php

declare(strict_types=1);

namespace App\Frontoffice\Query\Query;

use App\Career\Query\Repository\ActivityRepositoryInterface;
use Webmunkeez\CQRSBundle\Query\QueryHandlerInterface;

final class AboutQueryHandler implements QueryHandlerInterface
{
    private ActivityRepositoryInterface $activityRepository;

    public function __construct(ActivityRepositoryInterface $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    public function __invoke(AboutQuery $query): array
    {
        return [
            'activities' => $this->activityRepository->findByEmployee($query->getEmployeeId(), $query->getLanguageId()),
        ];
    }
}
