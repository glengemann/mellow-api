<?php

declare(strict_types=1);

namespace Mellow\Api\Login\Response;

use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class LoginResponseDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function denormalize(
        mixed $data,
        string $type,
        ?string $format = null,
        array $context = [],
    ): mixed {
        if (true === isset($data['2FA'])) {
            return $this->denormalizer->denormalize($data['2FA'], TwoFactorEnabledResponse::class, $format, $context);
        }

        return $this->denormalizer->denormalize($data, CredentialResponse::class, $format, $context);
    }

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return LoginResponse::class === $type;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            LoginResponse::class => true,
        ];
    }
}
