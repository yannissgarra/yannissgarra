<?php

declare(strict_types=1);

namespace App\Frontoffice\Presentation\Action;

use App\Common\Presentation\Action\AbstractAction;
use App\Frontoffice\Query\Query\AboutQuery;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;
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
        $query = (new AboutQuery())
            ->setEmployeeId(Uuid::fromString('ffe7d61f-f184-44a7-bce7-256e6cd8e7a3'))
            ->setLanguageId(Uuid::fromString('f0d0c1c9-a1f0-4057-a7f6-78e2673e4829'));

        /** @var array $result */
        $result = $this->queryBus->dispatch($query);

        return $this->render($result);
    }
}
