<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Response;

use App\Common\Presentation\Response\ResponderRenderFailedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface ResponderInterface
{
    public function supports(Request $request): bool;

    /**
     * @throws ResponderRenderFailedException
     */
    public function render(Request $request, array $data = []): Response;
}
