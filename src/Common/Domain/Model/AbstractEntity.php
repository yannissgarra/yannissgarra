<?php

declare(strict_types=1);

namespace App\Common\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Webmunkeez\CQRSDoctrineBundle\Model\IdentifiableInterface;
use Webmunkeez\CQRSDoctrineBundle\Model\IdentifiableTrait;

#[ORM\MappedSuperclass]
#[UniqueEntity(['id'])]
abstract class AbstractEntity implements IdentifiableInterface
{
    use IdentifiableTrait;

    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'uuid', unique: true)]
    #[Assert\NotBlank]
    #[Assert\Uuid]
    private Uuid $id;

    #[ORM\Column(name: 'created_at', type: 'datetime')]
    #[Assert\NotBlank]
    private \DateTime $createdAt;

    #[ORM\Column(name: 'last_updated_at', type: 'datetime')]
    #[Assert\NotBlank]
    private \DateTime $lastUpdatedAt;

    public function __construct()
    {
        // init values
        $this->generateId()
            ->setCreatedAt(new \DateTime())
            ->updateLastUpdatedAt()
        ;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getLastUpdatedAt(): \DateTime
    {
        return $this->lastUpdatedAt;
    }

    public function updateLastUpdatedAt(): static
    {
        $this->setLastUpdatedAt(new \DateTime());

        return $this;
    }

    private function generateId(): static
    {
        $this->setId(Uuid::v4());

        return $this;
    }

    private function setCreatedAt(\DateTime $date): static
    {
        $this->createdAt = $date;

        return $this;
    }

    private function setLastUpdatedAt(\DateTime $date): static
    {
        $this->lastUpdatedAt = $date;

        return $this;
    }
}
