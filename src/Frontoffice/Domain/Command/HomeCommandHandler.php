<?php

declare(strict_types=1);

namespace App\Frontoffice\Domain\Command;

use Webmunkeez\CQRSBundle\Command\CommandHandlerInterface;

final class HomeCommandHandler implements CommandHandlerInterface
{
    public function __invoke(HomeCommand $command): array
    {
        return [
            'profile' => [
                'name' => $command->getName(),
            ],
        ];
    }
}
