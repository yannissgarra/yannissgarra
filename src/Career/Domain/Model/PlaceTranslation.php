<?php

declare(strict_types=1);

namespace App\Career\Domain\Model;

use App\Career\Infrastructure\Doctrine\Repository\PlaceTranslationDoctrineORMRepository;
use App\Common\Domain\Model\AbstractEntity;
use App\Language\Domain\Model\Language;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(PlaceTranslationDoctrineORMRepository::class)]
#[ORM\Table('carr_place_translation')]
class PlaceTranslation extends AbstractEntity
{
    #[ORM\Column(name: 'description', type: 'text')]
    #[Assert\NotBlank]
    private string $description;

    #[ORM\Column(name: 'link', type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Url]
    private string $link;

    #[ORM\ManyToOne(targetEntity: Place::class, inversedBy: 'placeTranslations')]
    #[ORM\JoinColumn(name: 'place_id', referencedColumnName: 'id', nullable: false)]
    private Place $place;

    #[ORM\ManyToOne(targetEntity: Language::class, inversedBy: 'placeTranslations')]
    #[ORM\JoinColumn(name: 'language_id', referencedColumnName: 'id', nullable: false)]
    private Language $language;

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function updateDescription(string $description): self
    {
        $this->setDescription($description);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function updateLink(string $link): self
    {
        $this->setLink($link);
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
        $place->addPlaceTranslation($this);

        return $this;
    }

    public function updatePlace(Place $place): self
    {
        $this->place->removePlaceTranslation($this);
        $this->setPlace($place);
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
        $language->addPlaceTranslation($this);

        return $this;
    }

    public function updateLanguage(Language $language): self
    {
        $this->language->removePlaceTranslation($this);
        $this->setLanguage($language);
        $this->updateLastUpdatedAt();

        return $this;
    }
}
