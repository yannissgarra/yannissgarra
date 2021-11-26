<?php

declare(strict_types=1);

namespace App\Career\Query\Model;

use App\Common\Query\Model\AbstractModel;
use Symfony\Component\Uid\Uuid;

class Mission extends AbstractModel
{
    private Uuid $id;

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): static
    {
        $this->id = $id;

        return $this;
    }
}
