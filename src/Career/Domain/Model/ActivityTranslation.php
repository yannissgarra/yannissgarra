<?php

declare(strict_types=1);

namespace App\Career\Domain\Model;

use App\Career\Infrastructure\Doctrine\Repository\ActivityTranslationDoctrineORMRepository;
use App\Common\Domain\Model\AbstractEntity;
use App\Language\Domain\Model\Language;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(ActivityTranslationDoctrineORMRepository::class)]
#[ORM\Table('carr_activity_translation')]
class ActivityTranslation extends AbstractEntity
{
    #[ORM\Column(name: 'title', type: 'string')]
    #[Assert\NotBlank]
    private string $title;

    #[ORM\Column(name: 'description', type: 'text', nullable: true)]
    private ?string $description;

    #[ORM\ManyToOne(targetEntity: Activity::class, inversedBy: 'activityTranslations')]
    #[ORM\JoinColumn(name: 'activity_id', referencedColumnName: 'id', nullable: false)]
    private Activity $activity;

    #[ORM\ManyToOne(targetEntity: Language::class, inversedBy: 'activityTranslations')]
    #[ORM\JoinColumn(name: 'language_id', referencedColumnName: 'id', nullable: false)]
    private Language $language;

    public function __construct()
    {
        parent::__construct();

        // init values
        $this->description = null;
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

    public function getActivity(): Activity
    {
        return $this->activity;
    }

    public function setActivity(Activity $activity): self
    {
        $this->activity = $activity;
        $activity->addActivityTranslation($this);

        return $this;
    }

    public function updateActivity(Activity $activity): self
    {
        $this->activity->removeActivityTranslation($this);
        $this->setActivity($activity);
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
        $language->addActivityTranslation($this);

        return $this;
    }

    public function updateLanguage(Language $language): self
    {
        $this->language->removeActivityTranslation($this);
        $this->setLanguage($language);
        $this->updateLastUpdatedAt();

        return $this;
    }
}
