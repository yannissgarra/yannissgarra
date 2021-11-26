<?php

declare(strict_types=1);

namespace App\Frontoffice\Query\Query;

use Webmunkeez\CQRSBundle\Query\QueryHandlerInterface;

final class HomeQueryHandler implements QueryHandlerInterface
{
    public function __invoke(HomeQuery $query): array
    {
        return [];
    }
}
