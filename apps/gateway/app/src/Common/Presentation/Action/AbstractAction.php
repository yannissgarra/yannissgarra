<?php

declare(strict_types=1);

namespace App\Common\Presentation\Action;

use App\Common\Presentation\Response\ResponderInterface;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractAction implements ActionInterface
{
    private ResponderInterface $responder;

    public function setResponder(ResponderInterface $responder): void
    {
        $this->responder = $responder;
    }

    public function render(array $data = []): Response
    {
        return $this->responder->render($data);
    }
}
