<?php

declare(strict_types=1);

namespace App\Common\Domain\Model;

trait IdentifiableTrait
{
    public static function extractIds(array $identifiables): array
    {
        return array_values(array_map(function (self $identifiable) {
            return $identifiable->getId();
        }, $identifiables));
    }
}
