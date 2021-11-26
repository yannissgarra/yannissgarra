<?php

declare(strict_types=1);

namespace App\Career\Domain\Model;

use App\Career\Infrastructure\Doctrine\Repository\ActivityTranslationDoctrineORMRepository;
use App\Common\Domain\Model\AbstractEntity;
use App\Language\Domain\Model\Language;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(ActivityTranslationDoctrineORMRepository::class)]
#[ORM\Table('carr_employee_translation')]
class EmployeeTranslation extends AbstractEntity
{
    #[ORM\Column(name: 'role', type: 'string')]
    #[Assert\NotBlank]
    private string $role;

    #[ORM\Column(name: 'description', type: 'text', nullable: true)]
    private ?string $description;

    #[ORM\ManyToOne(targetEntity: Employee::class, inversedBy: 'employeeTranslations')]
    #[ORM\JoinColumn(name: 'employee_id', referencedColumnName: 'id', nullable: false)]
    private Employee $employee;

    #[ORM\ManyToOne(targetEntity: Language::class, inversedBy: 'employeeTranslations')]
    #[ORM\JoinColumn(name: 'language_id', referencedColumnName: 'id', nullable: false)]
    private Language $language;

    public function __construct()
    {
        parent::__construct();

        // init values
        $this->description = null;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function updateRole(string $role): self
    {
        $this->setRole($role);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function updateDescription(?string $description): self
    {
        $this->setDescription($description);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getEmployee(): Employee
    {
        return $this->employee;
    }

    public function setEmployee(Employee $employee): self
    {
        $this->employee = $employee;
        $employee->addEmployeeTranslation($this);

        return $this;
    }

    public function updateEmployee(Employee $employee): self
    {
        $this->employee->removeEmployeeTranslation($this);
        $this->setEmployee($employee);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function setLanguage(Language $language): self
    {
        $this->language = $language;
        $language->addEmployeeTranslation($this);

        return $this;
    }

    public function updateLanguage(Language $language): self
    {
        $this->language->removeEmployeeTranslation($this);
        $this->setLanguage($language);
        $this->updateLastUpdatedAt();

        return $this;
    }
}
