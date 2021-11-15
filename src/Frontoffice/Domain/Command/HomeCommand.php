<?php

declare(strict_types=1);

namespace App\Frontoffice\Domain\Command;

use Webmunkeez\CQRSBundle\Command\CommandInterface;

final class HomeCommand implements CommandInterface
{
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
