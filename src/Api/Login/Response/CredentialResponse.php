<?php

declare(strict_types=1);

namespace Mellow\Api\Login\Response;

final readonly class CredentialResponse implements LoginResponse
{
    public function __construct(
        public string $token,
        public string $refreshToken,
    ) {
    }

    public function requiresTwoFactor(): bool
    {
        return false;
    }
}
