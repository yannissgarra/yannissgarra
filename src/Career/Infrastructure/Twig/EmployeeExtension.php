<?php

declare(strict_types=1);

namespace App\Career\Infrastructure\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class EmployeeExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('employee', [EmployeeRuntime::class, 'findEmployee']),
        ];
    }
}
