<?php

declare(strict_types=1);

namespace App\Common\Query\Model;

use Webmunkeez\CQRSDoctrineBundle\Model\IdentifiableInterface;
use Webmunkeez\CQRSDoctrineBundle\Model\IdentifiableTrait;

abstract class AbstractModel implements IdentifiableInterface
{
    use IdentifiableTrait;
}
