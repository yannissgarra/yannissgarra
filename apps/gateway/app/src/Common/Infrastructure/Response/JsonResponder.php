<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

final class JsonResponder implements ResponderInterface
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function supports(Request $request): bool
    {
        return JsonEncoder::FORMAT === $request->getPreferredFormat();
    }

    public function render(Request $request, array $data = []): Response
    {
        $json = $this->serializer->serialize($data, JsonEncoder::FORMAT);

        return new JsonResponse($json, 200, [], true);
    }
}
