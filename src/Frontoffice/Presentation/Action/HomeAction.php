<?php

declare(strict_types=1);

namespace App\Frontoffice\Presentation\Action;

use App\Common\Presentation\Action\AbstractAction;
use App\Frontoffice\Domain\Command\HomeCommand;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Webmunkeez\ADRBundle\Annotation\Template;
use Webmunkeez\CQRSBundle\Command\CommandBusAwareInterface;
use Webmunkeez\CQRSBundle\Command\CommandBusAwareTrait;

#[Route('/', name: 'home', methods: ['GET'])]
#[Template('frontoffice/home.html.twig')]
final class HomeAction extends AbstractAction implements CommandBusAwareInterface
{
    use CommandBusAwareTrait;

    public function __invoke(): Response
    {
        $command = new HomeCommand();
        $command->setName('Yannis Sgarra');

        /** @var array $result */
        $result = $this->commandBus->dispatch($command);

        return $this->render($result);
    }
}
