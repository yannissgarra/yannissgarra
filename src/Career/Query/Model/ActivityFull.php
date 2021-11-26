<?php

declare(strict_types=1);

namespace App\Career\Query\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class ActivityFull extends ActivityMedium
{
    /**
     * @var Mission[]
     */
    private Collection $missions;

    public function __construct()
    {
        // init values
        $this->missions = new ArrayCollection();
    }

    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Mission $mission): self
    {
        $this->missions[] = $mission;

        return $this;
    }
}
