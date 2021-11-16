<?php

declare(strict_types=1);

namespace App\Common\Domain\Model;

use Symfony\Component\Uid\Uuid;

interface IdentifiableInterface
{
    public function getId(): Uuid;

    /**
     * @return Uuid[]
     */
    public static function extractIds(array $identifiables): array;
}
