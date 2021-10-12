<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

final class JsonResponder implements ResponderInterface
{
    private RequestStack $requestStack;
    private SerializerInterface $serializer;

    public function __construct(RequestStack $requestStack, SerializerInterface $serializer)
    {
        $this->requestStack = $requestStack;
        $this->serializer = $serializer;
    }

    public function supports(): bool
    {
        return 'json' === $this->requestStack->getCurrentRequest()->getPreferredFormat();
    }

    public function render(array $data = []): Response
    {
        $json = $this->serializer->serialize($data, 'json');

        return new JsonResponse($json, 200, [], true);
    }
}
