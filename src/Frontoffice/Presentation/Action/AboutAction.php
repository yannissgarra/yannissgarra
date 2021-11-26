<?php

declare(strict_types=1);

namespace App\Frontoffice\Presentation\Action;

use App\Common\Presentation\Action\AbstractAction;
use App\Frontoffice\Query\Query\AboutQuery;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Webmunkeez\ADRBundle\Annotation\Template;
use Webmunkeez\CQRSBundle\Query\QueryBusAwareInterface;
use Webmunkeez\CQRSBundle\Query\QueryBusAwareTrait;

#[Route(['en' => '/about', 'fr' => '/a-propos'], name: 'about', methods: ['GET'])]
#[Template('frontoffice/about.html.twig')]
final class AboutAction extends AbstractAction implements QueryBusAwareInterface
{
    use QueryBusAwareTrait;

    public function __invoke(): Response
    {
        $query = new AboutQuery();

        /** @var array $result */
        $result = $this->queryBus->dispatch($query);

        return $this->render($result);
    }
}
