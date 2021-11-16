<?php

declare(strict_types=1);

namespace App\Frontoffice\Presentation\Action;

use App\Common\Presentation\Action\AbstractAction;
use App\Frontoffice\Query\Query\HomeQuery;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Webmunkeez\ADRBundle\Annotation\Template;
use Webmunkeez\CQRSBundle\Query\QueryBusAwareInterface;
use Webmunkeez\CQRSBundle\Query\QueryBusAwareTrait;

#[Route('/', name: 'home', methods: ['GET'])]
#[Template('frontoffice/home.html.twig')]
final class HomeAction extends AbstractAction implements QueryBusAwareInterface
{
    use QueryBusAwareTrait;

    public function __invoke(): Response
    {
        $query = new HomeQuery();

        /** @var array $result */
        $result = $this->queryBus->dispatch($query);

        return $this->render($result);
    }
}
