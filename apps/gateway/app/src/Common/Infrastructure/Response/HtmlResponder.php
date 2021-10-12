<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Response;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class HtmlResponder implements ResponderInterface
{
    private RequestStack $requestStack;
    private Environment $twig;

    public function __construct(RequestStack $requestStack, Environment $twig)
    {
        $this->requestStack = $requestStack;
        $this->twig = $twig;
    }

    public function supports(): bool
    {
        return 'html' === $this->requestStack->getCurrentRequest()->getPreferredFormat() && null !== $this->requestStack->getCurrentRequest()->attributes->get('_template_path') ? true : false;
    }

    public function render(array $data = []): Response
    {
        $html = $this->twig->render($this->requestStack->getCurrentRequest()->attributes->get('_template_path'), $data);

        return new Response($html);
    }
}
