<?php

declare(strict_types=1);

namespace App\Career\Domain\Model;

use App\Career\Infrastructure\Doctrine\Repository\PlaceDoctrineORMRepository;
use App\Common\Domain\Model\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(PlaceDoctrineORMRepository::class)]
#[ORM\Table('carr_place')]
class Place extends AbstractEntity
{
    #[ORM\Column(name: 'name', type: 'string')]
    #[Assert\NotBlank]
    private string $name;

    #[ORM\OneToMany(targetEntity: PlaceTranslation::class, mappedBy: 'place', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $placeTranslations;

    #[ORM\OneToMany(targetEntity: Activity::class, mappedBy: 'place')]
    private Collection $activities;

    public function __construct()
    {
        parent::__construct();

        // init values
        $this->placeTranslations = new ArrayCollection();
        $this->activities = new ArrayCollection();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function updateName(string $name): self
    {
        $this->setName($name);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getPlaceTranslations(): Collection
    {
        return $this->placeTranslations;
    }

    public function addPlaceTranslation(PlaceTranslation $placeTranslation): self
    {
        $this->placeTranslations[] = $placeTranslation;
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function removePlaceTranslation(PlaceTranslation $placeTranslation): self
    {
        $this->placeTranslations->removeElement($placeTranslation);
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
