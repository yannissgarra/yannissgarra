<?php

declare(strict_types=1);

namespace App\Career\Infrastructure\Doctrine\Repository;

use App\Career\Query\Model\ActivityFull;
use App\Career\Query\Model\PlaceMedium;
use App\Career\Query\Repository\ActivityRepositoryInterface;
use App\Career\Query\Repository\MissionRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Uid\Uuid;
use Webmunkeez\CQRSDoctrineBundle\Doctrine\Repository\AbstractDoctrineDBALRepository;

final class ActivityDoctrineDBALRepository extends AbstractDoctrineDBALRepository implements ActivityRepositoryInterface
{
    private MissionRepositoryInterface $missionRepository;

    public function __construct(MissionRepositoryInterface $missionRepository)
    {
        $this->missionRepository = $missionRepository;
    }

    public function findByEmployee(Uuid $employeeId, Uuid $languageId): Collection
    {
        $qb = $this->createBaseQueryBuilder($languageId);

        $qb->andWhere($qb->expr()->in('activity.employee_id', ':employee_id'))
            ->setParameter('employee_id', $employeeId);

        $qb->orderBy('activity.stopped_at', Criteria::DESC);

        $datas = $qb->executeQuery()->fetchAllAssociative();

        $activities = new ArrayCollection();

        /** @var array $data */
        foreach ($datas as $data) {
            $activity = (new ActivityFull())
                ->setId(Uuid::fromString($data['activity_id']))
                ->setTitle($data['activity_title'])
                ->setDescription($data['activity_description'])
                ->setStartedAt(new \DateTime($data['activity_started_at']))
                ->setStoppedAt(null !== $data['activity_stopped_at'] ? new \DateTime($data['activity_stopped_at']) : null)
                ->setPlace((new PlaceMedium())
                    ->setId(Uuid::fromString($data['place_id']))
                    ->setName($data['place_name'])
                    ->setDescription($data['place_description'])
                    ->setLink($data['place_link'])
                )
                ->setType($data['activity_type']);

            $activities->add($activity);
        }

        $this->missionRepository->populateActivities($activities, $languageId);

        return $activities;
    }

    private function createBaseQueryBuilder(Uuid $languageId): QueryBuilder
    {
        $qb = $this->createQueryBuilder();

        $qb->select('activity.id as activity_id', 'activity.started_at as activity_started_at', 'activity.stopped_at as activity_stopped_at', 'activity.type as activity_type')
            ->from('carr_activity', 'activity');

        $qb->addSelect('activityTranslation.title as activity_title', 'activityTranslation.description as activity_description')
            ->join('activity', 'carr_activity_translation', 'activityTranslation', $qb->expr()->and(
                $qb->expr()->eq('activityTranslation.activity_id', 'activity.id'),
                $qb->expr()->eq('activityTranslation.language_id', ':language_id')
            ))
            ->setParameter('language_id', $languageId);

        $qb->addSelect('place.id as place_id', 'place.name as place_name')
            ->join('activity', 'carr_place', 'place', $qb->expr()->eq('place.id', 'activity.place_id'));

        $qb->addSelect('placeTranslation.description as place_description', 'placeTranslation.link as place_link')
            ->join('place', 'carr_place_translation', 'placeTranslation', $qb->expr()->and(
                $qb->expr()->eq('placeTranslation.place_id', 'place.id'),
                $qb->expr()->eq('placeTranslation.language_id', ':language_id')
            ))
            ->setParameter('language_id', $languageId);

        return $qb;
    }
}
