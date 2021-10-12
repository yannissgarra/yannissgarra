<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Response;

use App\Common\Presentation\Response\ResponderInterface as PresentationResponderInterface;
use App\Common\Presentation\Response\ResponderRenderFailedException;
use Symfony\Component\HttpFoundation\Response;

final class Responder implements PresentationResponderInterface
{
    /**
     * @var ResponderInterface[]
     */
    private array $responders;

    public function __construct(iterable $responders)
    {
        $this->responders = iterator_to_array($responders);
    }

    public function render(array $data = []): Response
    {
        foreach ($this->responders as $responder) {
            if (true === $responder->supports()) {
                return $responder->render($data);
            }
        }

        throw new ResponderRenderFailedException(/*TODO: previous = ResponderNotFoundException*/);
    }
}
