<?php

declare(strict_types=1);

namespace App\Career\Domain\Model;

use App\Career\Infrastructure\Doctrine\Repository\MissionDoctrineORMRepository;
use App\Common\Domain\Model\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(MissionDoctrineORMRepository::class)]
#[ORM\Table('carr_mission')]
class Mission extends AbstractEntity
{
    #[ORM\Column(name: 'reference', type: 'string')]
    #[Assert\NotBlank]
    private string $reference;

    #[ORM\Column(name: 'customer', type: 'string', nullable: true)]
    private ?string $customer;

    #[ORM\Column(name: 'position', type: 'integer')]
    private int $position;

    #[ORM\ManyToOne(targetEntity: Activity::class, inversedBy: 'missions')]
    #[ORM\JoinColumn(name: 'activity_id', referencedColumnName: 'id', nullable: false)]
    private Activity $activity;

    #[ORM\OneToMany(targetEntity: MissionTranslation::class, mappedBy: 'mission', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $missionTranslations;

    public function __construct()
    {
        parent::__construct();

        // init values
        $this->customer = null;
        $this->missionTranslations = new ArrayCollection();
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

    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    public function setCustomer(?string $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function updateCustomer(?string $customer): self
    {
        $this->setCustomer($customer);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function updatePosition(int $position): self
    {
        $this->setPosition($position);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function initPosition(): self
    {
        $this->setPosition(0);

        if ($this->activity->getMissions()->count() > 0) {
            $positions = array_map(function (Mission $mission) {
                return $mission->getPosition();
            }, $this->activity->getMissions()->toArray());

            rsort($positions);

            $this->setPosition($positions[0] + 1);
        }

        return $this;
    }

    public function getActivity(): Activity
    {
        return $this->activity;
    }

    public function setActivity(Activity $activity): self
    {
        $this->activity = $activity;
        $activity->addMission($this);

        $this->initPosition();

        return $this;
    }

    public function updateActivity(Activity $activity): self
    {
        $this->activity->removeMission($this);
        $this->setActivity($activity);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getMissionTranslations(): Collection
    {
        return $this->missionTranslations;
    }

    public function addMissionTranslation(MissionTranslation $missionTranslation): self
    {
        $this->missionTranslations[] = $missionTranslation;
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function removeMissionTranslation(MissionTranslation $missionTranslation): self
    {
        $this->missionTranslations->removeElement($missionTranslation);
        $this->updateLastUpdatedAt();

        return $this;
    }
}
