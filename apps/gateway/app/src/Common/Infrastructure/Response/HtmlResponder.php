<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class HtmlResponder implements ResponderInterface
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function supports(Request $request): bool
    {
        return 'html' === $request->getPreferredFormat() && null !== $request->attributes->get('_template_path') ? true : false;
    }

    public function render(Request $request, array $data = []): Response
    {
        $html = $this->twig->render($request->attributes->get('_template_path'), $data);

        return new Response($html);
    }
}
