<?php

declare(strict_types=1);

namespace App\Career\Domain\Model;

use App\Career\Infrastructure\Doctrine\Repository\ActivityDoctrineORMRepository;
use App\Common\Domain\Model\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(ActivityDoctrineORMRepository::class)]
#[ORM\Table('carr_employee')]
class Employee extends AbstractEntity
{
    #[ORM\Column(name: 'first_name', type: 'string')]
    #[Assert\NotBlank]
    private string $firstName;

    #[ORM\Column(name: 'last_name', type: 'string')]
    #[Assert\NotBlank]
    private string $lastName;

    #[ORM\Column(name: 'email', type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Email]
    private string $email;

    #[ORM\Column(name: 'github_url', type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Url]
    private string $githubUrl;

    #[ORM\Column(name: 'linkedin_url', type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Url]
    private string $linkedinUrl;

    #[ORM\Column(name: 'twitter_url', type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Url]
    private string $twitterUrl;

    #[ORM\OneToMany(targetEntity: EmployeeTranslation::class, mappedBy: 'employee', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $employeeTranslations;

    #[ORM\OneToMany(targetEntity: Activity::class, mappedBy: 'employee')]
    private Collection $activities;

    public function __construct()
    {
        parent::__construct();

        // init values
        $this->employeeTranslations = new ArrayCollection();
        $this->activities = new ArrayCollection();
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function updateFirstName(string $firstName): self
    {
        $this->setFirstName($firstName);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function updateLastName(string $lastName): self
    {
        $this->setLastName($lastName);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function updateEmail(string $email): self
    {
        $this->setEmail($email);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getGithubUrl(): string
    {
        return $this->githubUrl;
    }

    public function setGithubUrl(string $githubUrl): self
    {
        $this->githubUrl = $githubUrl;

        return $this;
    }

    public function updateGithubUrl(string $githubUrl): self
    {
        $this->setGithubUrl($githubUrl);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getLinkedinUrl(): string
    {
        return $this->linkedinUrl;
    }

    public function setLinkedinUrl(string $linkedinUrl): self
    {
        $this->linkedinUrl = $linkedinUrl;

        return $this;
    }

    public function updateLinkedinUrl(string $linkedinUrl): self
    {
        $this->setLinkedinUrl($linkedinUrl);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getTwitterUrl(): string
    {
        return $this->twitterUrl;
    }

    public function setTwitterUrl(string $twitterUrl): self
    {
        $this->twitterUrl = $twitterUrl;

        return $this;
    }

    public function updateTwitterUrl(string $twitterUrl): self
    {
        $this->setTwitterUrl($twitterUrl);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getEmployeeTranslations(): Collection
    {
        return $this->employeeTranslations;
    }

    public function addEmployeeTranslation(EmployeeTranslation $employeeTranslation): self
    {
        $this->employeeTranslations[] = $employeeTranslation;
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function removeEmployeeTranslation(EmployeeTranslation $employeeTranslation): self
    {
        $this->employeeTranslations->removeElement($employeeTranslation);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activity $activity): self
    {
        $this->activities[] = $activity;
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        $this->activities->removeElement($activity);
        $this->updateLastUpdatedAt();

        return $this;
    }
}
