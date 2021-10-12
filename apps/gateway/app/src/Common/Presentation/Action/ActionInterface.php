<?php

declare(strict_types=1);

namespace App\Common\Presentation\Action;

use App\Common\Presentation\Response\ResponderRenderFailedException;
use Symfony\Component\HttpFoundation\Response;

interface ActionInterface
{
    /**
     * @throws ResponderRenderFailedException
     */
    public function render(array $data = []): Response;
}
