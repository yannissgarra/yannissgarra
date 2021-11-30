<?php

declare(strict_types=1);

namespace App\Frontoffice\Infrastructure\Twig;

use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\RuntimeExtensionInterface;

final class DarkModeRuntime implements RuntimeExtensionInterface
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function getDarkModeClass(): string
    {
        if (null !== $this->requestStack->getCurrentRequest()->cookies->get('darkMode')) {
            $data = json_decode($this->requestStack->getCurrentRequest()->cookies->get('darkMode'), true);

            return $data['activatedMode'];
        }

        return 'light';
    }
}
