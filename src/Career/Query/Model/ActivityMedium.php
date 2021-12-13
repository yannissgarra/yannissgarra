<?php

declare(strict_types=1);

namespace App\Career\Query\Model;

use App\Career\Domain\Model\ActivityType;
use Symfony\Component\Uid\Uuid;

class ActivityMedium extends Activity
{
    private string $title;
    private ?string $description;
    private \DateTime $startedAt;
    private ?\DateTime $stoppedAt;
    private Place $place;
    private ActivityType $type;

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getStoppedAt(): ?\DateTime
    {
        return $this->stoppedAt;
    }

    public function setStoppedAt(?\DateTime $stoppedAt): self
    {
        $this->stoppedAt = $stoppedAt;

        return $this;
    }

    public function getPlace(): Place
    {
        return $this->place;
    }

    public function setPlace(Place $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getType(): ActivityType
    {
        return $this->type;
    }

    public function setType(ActivityType $type): self
    {
        $this->type = $type;

        return $this;
    }
}
