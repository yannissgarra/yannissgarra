<?php

declare(strict_types=1);

namespace App\Career\Domain\Model;

enum ActivityType: string
{
    case Training = 'TRAINING';
    case Work = 'WORK';
    case Project = 'PROJECT';
}
