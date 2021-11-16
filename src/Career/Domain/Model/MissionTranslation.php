<?php

declare(strict_types=1);

namespace App\Career\Domain\Model;

use App\Career\Infrastructure\Doctrine\Repository\MissionTranslationDoctrineORMRepository;
use App\Common\Domain\Model\AbstractEntity;
use App\Language\Domain\Model\Language;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(MissionTranslationDoctrineORMRepository::class)]
#[ORM\Table('carr_mission_translation')]
class MissionTranslation extends AbstractEntity
{
    #[ORM\Column(name: 'role', type: 'string')]
    #[Assert\NotBlank]
    private string $role;

    #[ORM\Column(name: 'environment', type: 'text')]
    #[Assert\NotBlank]
    private string $environment;

    #[ORM\Column(name: 'description', type: 'text')]
    #[Assert\NotBlank]
    private string $description;

    #[ORM\Column(name: 'link', type: 'string', nullable: true)]
    #[Assert\Url]
    private ?string $link;

    #[ORM\ManyToOne(targetEntity: Mission::class, inversedBy: 'missionTranslations')]
    #[ORM\JoinColumn(name: 'mission_id', referencedColumnName: 'id', nullable: false)]
    private Mission $mission;

    #[ORM\ManyToOne(targetEntity: Language::class, inversedBy: 'missionTranslations')]
    #[ORM\JoinColumn(name: 'language_id', referencedColumnName: 'id', nullable: false)]
    private Language $language;

    public function __construct()
    {
        parent::__construct();

        // init values
        $this->link = null;
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

    public function getEnvironment(): string
    {
        return $this->environment;
    }

    public function setEnvironment(string $environment): self
    {
        $this->environment = $environment;

        return $this;
    }

    public function updateEnvironment(string $environment): self
    {
        $this->setEnvironment($environment);
        $this->updateLastUpdatedAt();

        return $this;
    }

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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function updateLink(?string $link): self
    {
        $this->setLink($link);
        $this->updateLastUpdatedAt();

        return $this;
    }

    public function getMission(): Mission
    {
        return $this->mission;
    }

    public function setMission(Mission $mission): self
    {
        $this->mission = $mission;
        $mission->addMissionTranslation($this);

        return $this;
    }

    public function updateMission(Mission $mission): self
    {
        $this->mission->removeMissionTranslation($this);
        $this->setMission($mission);
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
        $language->addMissionTranslation($this);

        return $this;
    }

    public function updateLanguage(Language $language): self
    {
        $this->language->removeMissionTranslation($this);
        $this->setLanguage($language);
        $this->updateLastUpdatedAt();

        return $this;
    }
}
