<?php

declare(strict_types=1);

namespace App\Frontoffice\Presentation\Action;

use App\Common\Infrastructure\Twig\Template;
use App\Common\Presentation\Action\ActionInterface;
use App\Common\Presentation\Response\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: self::ROUTE_NAME, methods: ['GET'])]
#[Template('frontoffice/home.html.twig')]
final class HomeAction implements ActionInterface
{
    public const ROUTE_NAME = 'home';

    private ResponderInterface $responder;

    public function __construct(ResponderInterface $responder)
    {
        $this->responder = $responder;
    }

    public function __invoke(Request $request): Response
    {
        return $this->responder->render($request, [
            'profile' => [
                'name' => 'Yannis Sgarra',
            ],
        ]);
    }
}
