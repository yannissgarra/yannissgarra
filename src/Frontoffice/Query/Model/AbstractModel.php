<?php

declare(strict_types=1);

namespace App\Common\Query\Model;

use App\Common\Domain\Model\IdentifiableInterface;
use App\Common\Domain\Model\IdentifiableTrait;

abstract class AbstractModel implements IdentifiableInterface
{
    use IdentifiableTrait;
}
