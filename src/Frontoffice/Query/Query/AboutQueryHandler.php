<?php

declare(strict_types=1);

namespace App\Frontoffice\Query\Query;

use App\Career\Domain\Model\ActivityType;
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
        $activities = $this->activityRepository->findByEmployee($query->getEmployeeId(), $query->getLanguageId());

        return [
            'trainings' => $activities->filter(fn ($activity) => in_array($activity->getType(), [ActivityType::Training])),
            'works' => $activities->filter(fn ($activity) => in_array($activity->getType(), [ActivityType::Work, ActivityType::Project])),
        ];
    }
}
