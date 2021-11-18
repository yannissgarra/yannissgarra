<?php

declare(strict_types=1);

namespace App\Career\Infrastructure\Doctrine\Repository;

use App\Career\Query\Model\Activity;
use App\Career\Query\Model\Mission;
use App\Career\Query\Repository\MissionRepositoryInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Uid\Uuid;
use Webmunkeez\CQRSDoctrineBundle\Doctrine\Repository\AbstractDoctrineDBALRepository;

final class MissionDoctrineDBALRepository extends AbstractDoctrineDBALRepository implements MissionRepositoryInterface
{
    public function populateActivities(Collection $activities, Uuid $languageId): void
    {
        $qb = $this->createBaseQueryBuilder($languageId);

        $qb->andWhere($qb->expr()->in('mission.activity_id', ':activity_ids'))
            ->setParameter('activity_ids', Activity::extractIds($activities->toArray()), Connection::PARAM_STR_ARRAY)
        ;

        $qb->orderBy('mission.position', Criteria::ASC);

        $datas = $qb->executeQuery()->fetchAllAssociative();

        /** @var array $data */
        foreach ($datas as $data) {
            /** @var Activity $activity */
            foreach ($activities as $activity) {
                if ($activity->getId()->equals(Uuid::fromString($data['activity_id']))) {
                    $mission = (new Mission())
                        ->setId(Uuid::fromString($data['mission_id']))
                        ->setCustomer($data['mission_customer'])
                        ->setRole($data['mission_role'])
                        ->setEnvironment($data['mission_environment'])
                        ->setDescription($data['mission_description'])
                        ->setLink($data['mission_link'])
                    ;

                    $activity->addMission($mission);

                    break;
                }
            }
        }
    }

    private function createBaseQueryBuilder(Uuid $languageId): QueryBuilder
    {
        $qb = $this->createQueryBuilder();

        $qb->select('mission.id as mission_id', 'mission.customer as mission_customer', 'mission.activity_id as activity_id')
            ->from('carr_mission', 'mission')
        ;

        $qb->addSelect('missionTranslation.role as mission_role', 'missionTranslation.environment as mission_environment', 'missionTranslation.description as mission_description', 'missionTranslation.link as mission_link')
            ->join('mission', 'carr_mission_translation', 'missionTranslation', $qb->expr()->and(
                $qb->expr()->eq('missionTranslation.mission_id', 'mission.id'),
                $qb->expr()->eq('missionTranslation.language_id', ':language_id')
            ))
            ->setParameter('language_id', $languageId)
        ;

        return $qb;
    }
}
