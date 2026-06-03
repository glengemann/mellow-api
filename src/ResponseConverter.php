<?php

declare(strict_types=1);

namespace Mellow;

use Mellow\Api\Login\Response\LoginResponseDenormalizer;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ResponseConverter
{
    private readonly Serializer $serializer;

    public function __construct(
        ?Serializer $serializer = null,
    ) {
        $propertyInfo = new PropertyInfoExtractor([], [new PhpDocExtractor(), new ReflectionExtractor()]);
        $classMetadataFactory = new ClassMetadataFactory(new AttributeLoader());
        $nameConverter = new MetadataAwareNameConverter($classMetadataFactory);

        $normalizers = [
            new LoginResponseDenormalizer(),
            new DateTimeNormalizer([
                DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i:s',
            ]),
            new BackedEnumNormalizer(),
            new ObjectNormalizer($classMetadataFactory, $nameConverter, null, $propertyInfo),
            new ArrayDenormalizer(),
        ];

        $this->serializer = $serializer ?? new Serializer(
            $normalizers,
            [new JsonEncoder()],
        );
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
            ?? $payload['price']
            ?? $payload['workerId']
            ?? json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
