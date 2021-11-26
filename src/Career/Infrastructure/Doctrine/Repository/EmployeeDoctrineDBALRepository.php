<?php

declare(strict_types=1);

namespace App\Career\Infrastructure\Doctrine\Repository;

use App\Career\Query\Model\EmployeeFull;
use App\Career\Query\Repository\EmployeeRepositoryInterface;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\Uid\Uuid;
use Webmunkeez\CQRSDoctrineBundle\Doctrine\Repository\AbstractDoctrineDBALRepository;

final class EmployeeDoctrineDBALRepository extends AbstractDoctrineDBALRepository implements EmployeeRepositoryInterface
{
    public function findOne(Uuid $id, Uuid $languageId): EmployeeFull
    {
        $qb = $this->createBaseQueryBuilder($languageId);

        $qb->andWhere($qb->expr()->in('employee.id', ':id'))
            ->setParameter('id', $id);

        $data = $qb->executeQuery()->fetchAssociative();

        $employee = (new EmployeeFull())
            ->setId(Uuid::fromString($data['employee_id']))
            ->setFirstName($data['employee_first_name'])
            ->setLastName($data['employee_last_name'])
            ->setRole($data['employee_role'])
            ->setDescription($data['employee_description'])
            ->setEmail($data['employee_email'])
            ->setGithubUrl($data['employee_github_url'])
            ->setLinkedinUrl($data['employee_linkedin_url'])
            ->setTwitterUrl($data['employee_twitter_url']);

        return $employee;
    }

    private function createBaseQueryBuilder(Uuid $languageId): QueryBuilder
    {
        $qb = $this->createQueryBuilder();

        $qb->select('employee.id as employee_id', 'employee.first_name as employee_first_name', 'employee.last_name as employee_last_name', 'employee.email as employee_email', 'employee.github_url as employee_github_url', 'employee.linkedin_url as employee_linkedin_url', 'employee.twitter_url as employee_twitter_url')
            ->from('carr_employee', 'employee');

        $qb->addSelect('employeeTranslation.role as employee_role', 'employeeTranslation.description as employee_description')
            ->join('employee', 'carr_employee_translation', 'employeeTranslation', $qb->expr()->and(
                $qb->expr()->eq('employeeTranslation.employee_id', 'employee.id'),
                $qb->expr()->eq('employeeTranslation.language_id', ':language_id')
            ))
            ->setParameter('language_id', $languageId);

        return $qb;
    }
}
