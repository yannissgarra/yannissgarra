<?php

declare(strict_types=1);

namespace App\Frontoffice\Presentation\Action;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: self::ROUTE_NAME, methods: ['GET'])]
final class HomeAction
{
    public const ROUTE_NAME = 'home';

    public function __invoke(): Response
    {
        return new Response('ok');
    }
}
