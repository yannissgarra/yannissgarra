<?php

declare(strict_types=1);

namespace App\Frontoffice\Infrastructure\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class DarkModeExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('darkModeClass', [DarkModeRuntime::class, 'getDarkModeClass']),
        ];
    }
}
