<?php

declare(strict_types=1);

namespace App\Career\Infrastructure\Doctrine\Repository;

use App\Career\Query\Model\Activity;
use App\Career\Query\Model\Place;
use App\Career\Query\Repository\ActivityRepositoryInterface;
use App\Career\Query\Repository\MissionRepositoryInterface;
use App\Common\Infrastructure\Doctrine\Repository\AbstractDoctrineDBALRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Uid\Uuid;

final class ActivityDoctrineDBALRepository extends AbstractDoctrineDBALRepository implements ActivityRepositoryInterface
{
    private MissionRepositoryInterface $missionRepository;

    public function __construct(MissionRepositoryInterface $missionRepository)
    {
        $this->missionRepository = $missionRepository;
    }

    public function findByTypes(array $types, Uuid $languageId): Collection
    {
        $qb = $this->createBaseQueryBuilder($languageId);

        $qb->andWhere($qb->expr()->in('activity.type', ':types'))
            ->setParameter('types', $types, Connection::PARAM_STR_ARRAY)
        ;

        $qb->orderBy('activity.stopped_at', Criteria::DESC);

        $datas = $qb->executeQuery()->fetchAllAssociative();

        $activities = new ArrayCollection();

        /** @var array $data */
        foreach ($datas as $data) {
            $activity = (new Activity())
                ->setId(Uuid::fromString($data['activity_id']))
                ->setTitle($data['activity_title'])
                ->setDescription($data['activity_description'])
                ->setStartedAt(new \DateTime($data['activity_started_at']))
                ->setStoppedAt(null !== $data['activity_stopped_at'] ? new \DateTime($data['activity_stopped_at']) : null)
                ->setPlace((new Place())
                    ->setId(Uuid::fromString($data['place_id']))
                    ->setName($data['place_name'])
                    ->setDescription($data['place_description'])
                    ->setLink($data['place_link'])
                )
            ;

            $activities->add($activity);
        }

        $this->missionRepository->populateActivities($activities, $languageId);

        return $activities;
    }

    private function createBaseQueryBuilder(Uuid $languageId): QueryBuilder
    {
        $qb = $this->createQueryBuilder();

        $qb->select('activity.id as activity_id', 'activity.started_at as activity_started_at', 'activity.stopped_at as activity_stopped_at')
            ->from('carr_activity', 'activity')
        ;

        $qb->addSelect('activityTranslation.title as activity_title', 'activityTranslation.description as activity_description')
            ->join('activity', 'carr_activity_translation', 'activityTranslation', $qb->expr()->and(
                $qb->expr()->eq('activityTranslation.activity_id', 'activity.id'),
                $qb->expr()->eq('activityTranslation.language_id', ':language_id')
            ))
            ->setParameter('language_id', $languageId)
        ;

        $qb->addSelect('place.id as place_id', 'place.name as place_name')
            ->join('activity', 'carr_place', 'place', $qb->expr()->eq('place.id', 'activity.place_id'))
        ;

        $qb->addSelect('placeTranslation.description as place_description', 'placeTranslation.link as place_link')
            ->join('place', 'carr_place_translation', 'placeTranslation', $qb->expr()->and(
                $qb->expr()->eq('placeTranslation.place_id', 'place.id'),
                $qb->expr()->eq('placeTranslation.language_id', ':language_id')
            ))
            ->setParameter('language_id', $languageId)
        ;

        return $qb;
    }
}
