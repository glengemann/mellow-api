<?php

declare(strict_types=1);

namespace Mellow;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ResponseConverter
{
    private readonly Serializer $serializer;

    public function __construct()
    {
        $classMetadataFactory = new ClassMetadataFactory(new AttributeLoader());
        $nameConverter = new MetadataAwareNameConverter($classMetadataFactory);

        $normalizers = [
            new ArrayDenormalizer(),
            new ObjectNormalizer($classMetadataFactory, $nameConverter),
        ];

        $this->serializer = $serializer ?? new Serializer($normalizers);
    }

    /**
     * @return array|object
     */
    public function convert(
        ResponseInterface $response,
        string $type,
    ) {
        $raw = $response->getBody()->getContents();
        $statusCode = $response->getStatusCode();

        $payload = $this->decodePayload($raw);

        if ($statusCode < 200 || $statusCode >= 300) {
            $error = $this->resolveErrorMessage(
                $statusCode,
                $response->getHeaders(),
                $payload,
            );
            throw new \RuntimeException(sprintf('[%d] %s', $statusCode, $error));
        }

        $payload = $payload['items'] ?? $payload;

        return $this->serializer->denormalize($payload, $type);
    }

    /**
     * @return array<string, mixed>
     */
    private function decodePayload(string $raw): array
    {
        if ('' === $raw) {
            return [];
        }

        try {
            $decoded = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            return [];
        }

        return true === is_array($decoded) ? $decoded : [];
    }

    /**
     * @param array<string, array<int, string>> $headers
     * @param array<string, mixed> $payload
     */
    private function resolveErrorMessage(
        int $statusCode,
        array $headers,
        array $payload,
    ): string {
        if (429 === $statusCode) {
            $retryAfterHeader = $headers['retry-after'][0] ?? null;

            if (null !== $retryAfterHeader) {
                return sprintf('Rate limit exceeded. Retry in %d seconds.', $retryAfterHeader);
            }

            return 'Rate limit exceeded. Retry later.';
        }

        return $payload['email']
            ?? $payload['taskId']
            ?? $payload['error']
            ?? $payload['message']
            ?? $payload['uuid']
            ?? 'Unknown error';
    }
}
