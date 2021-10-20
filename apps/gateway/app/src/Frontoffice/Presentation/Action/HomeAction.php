<?php

declare(strict_types=1);

namespace App\Frontoffice\Presentation\Action;

use App\Common\Presentation\Action\AbstractAction;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Webmunkeez\AdrBundle\Annotation\Template;

#[Route('/', name: self::ROUTE_NAME, methods: ['GET'])]
#[Template('frontoffice/home.html.twig')]
final class HomeAction extends AbstractAction
{
    public const ROUTE_NAME = 'home';

    public function __invoke(): Response
    {
        return $this->render([
            'profile' => [
                'name' => 'Yannis Sgarra',
            ],
        ]);
    }
}
