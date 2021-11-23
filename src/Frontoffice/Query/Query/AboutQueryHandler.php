<?php

declare(strict_types=1);

namespace App\Frontoffice\Query\Query;

use App\Career\Query\Repository\ActivityRepositoryInterface;
use Symfony\Component\Uid\Uuid;
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
        $trainings = $this->activityRepository->findByTypes(['training'], Uuid::fromString('f0d0c1c9-a1f0-4057-a7f6-78e2673e4829'));

        $works = $this->activityRepository->findByTypes(['work', 'project'], Uuid::fromString('f0d0c1c9-a1f0-4057-a7f6-78e2673e4829'));

        return [
            'trainings' => $trainings,
            'works' => $works,
        ];
    }
}
