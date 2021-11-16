<?php

declare(strict_types=1);

namespace App\Language\Domain\Model;

use App\Career\Domain\Model\ActivityTranslation;
use App\Career\Domain\Model\MissionTranslation;
use App\Career\Domain\Model\PlaceTranslation;
use App\Common\Domain\Model\AbstractEntity;
use App\Language\Infrastructure\Doctrine\Repository\LanguageDoctrineORMRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(LanguageDoctrineORMRepository::class)]
#[ORM\Table('lng_language')]
#[UniqueEntity(['locale'])]
class Language extends AbstractEntity
{
    #[ORM\Column(name: 'title', type: 'string')]
    #[Assert\NotBlank]
    private string $title;

    #[ORM\Column(name: 'locale', type: 'string')]
    #[Assert\NotBlank]
    private string $locale;

    #[ORM\OneToMany(targetEntity: PlaceTranslation::class, mappedBy: 'language')]
    private Collection $placeTranslations;

    #[ORM\OneToMany(targetEntity: ActivityTranslation::class, mappedBy: 'language')]
    private Collection $activityTranslations;

    #[ORM\OneToMany(targetEntity: MissionTranslation::class, mappedBy: 'language')]
    private Collection $missionTranslations;

    public function __construct()
    {
        parent::__construct();

        // init values
        $this->placeTranslations = new ArrayCollection();
        $this->activityTranslations = new ArrayCollection();
        $this->missionTranslations = new ArrayCollection();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function updateTitle(string $title): self
    {
        $this->setTitle($title);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function updateLocale(string $locale): self
    {
        $this->setLocale($locale);
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
