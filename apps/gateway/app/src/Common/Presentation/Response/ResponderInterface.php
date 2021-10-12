<?php

declare(strict_types=1);

namespace App\Common\Presentation\Response;

use Symfony\Component\HttpFoundation\Response;

interface ResponderInterface
{
    /**
     * @throws ResponderRenderFailedException
     */
    public function render(array $data = []): Response;
}
