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
#[ORM\Table('carr_activity')]
class Activity extends AbstractEntity
{
    #[ORM\Column(name: 'reference', type: 'string')]
    #[Assert\NotBlank]
    private string $reference;

    #[ORM\Column(name: 'started_at', type: 'datetime')]
    #[Assert\NotBlank]
    private \DateTime $startedAt;

    #[ORM\Column(name: 'stopped_at', type: 'datetime', nullable: true)]
    #[Assert\GreaterThan(propertyPath: 'startedAt')]
    private ?\DateTime $stoppedAt;

    #[ORM\Column(name: 'type', type: 'string')]
    #[Assert\NotBlank]
    private string $type;

    #[ORM\ManyToOne(targetEntity: Place::class, inversedBy: 'activities')]
    #[ORM\JoinColumn(name: 'place_id', referencedColumnName: 'id', nullable: false)]
    private Place $place;

    #[ORM\OneToMany(targetEntity: ActivityTranslation::class, mappedBy: 'activity', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $activityTranslations;

    #[ORM\OneToMany(targetEntity: Mission::class, mappedBy: 'activity')]
    private Collection $missions;

    public function __construct()
    {
        parent::__construct();

        // init values
        $this->stoppedAt = null;
        $this->activityTranslations = new ArrayCollection();
        $this->missions = new ArrayCollection();
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function updateReference(string $reference): self
    {
        $this->setReference($reference);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getStartedAt(): \DateTime
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTime $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function updateStartedAt(\DateTime $startedAt): self
    {
        $this->setStartedAt($startedAt);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getStoppedAt(): ?\DateTime
    {
        return $this->stoppedAt;
    }

    public function setStoppedAt(?\DateTime $stoppedAt): self
    {
        $this->stoppedAt = $stoppedAt;

        return $this;
    }

    public function updateStoppedAt(?\DateTime $stoppedAt): self
    {
        $this->setStoppedAt($stoppedAt);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function updateType(string $type): self
    {
        $this->setType($type);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getPlace(): Place
    {
        return $this->place;
    }

    public function setPlace(Place $place): self
    {
        $this->place = $place;
        $place->addActivity($this);

        return $this;
    }

    public function updatePlace(Place $place): self
    {
        $this->place->removeActivity($this);
        $this->setPlace($place);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getActivityTranslations(): Collection
    {
        return $this->activityTranslations;
    }

    public function addActivityTranslation(ActivityTranslation $activityTranslation): self
    {
        $this->activityTranslations[] = $activityTranslation;
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function removeActivityTranslation(ActivityTranslation $activityTranslation): self
    {
        $this->activityTranslations->removeElement($activityTranslation);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Mission $mission): self
    {
        $this->missions[] = $mission;
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        $this->missions->removeElement($mission);
        $this->updateLastUpdatedAt();

        return $this;
    }
}
