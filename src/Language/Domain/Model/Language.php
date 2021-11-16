<?php

declare(strict_types=1);

namespace App\Language\Domain\Model;

use App\Common\Domain\Model\AbstractEntity;
use App\Language\Infrastructure\Doctrine\Repository\LanguageDoctrineORMRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(LanguageDoctrineORMRepository::class)]
#[ORM\Table('lng_language')]
#[UniqueEntity(['locale'])]
final class Language extends AbstractEntity
{
    #[ORM\Column(name: 'title', type: 'string')]
    #[Assert\NotBlank]
    private string $title;

    #[ORM\Column(name: 'locale', type: 'string')]
    #[Assert\NotBlank]
    private string $locale;

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
}
