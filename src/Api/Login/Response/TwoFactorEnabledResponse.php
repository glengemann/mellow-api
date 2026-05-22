<?php

declare(strict_types=1);

namespace Mellow\Api\Login\Response;

class TwoFactorEnabledResponse implements LoginResponse
{
    public function __construct(
        public readonly string $type,
        public readonly ?string $number,
    ) {
    }

    public function requiresTwoFactor(): bool
    {
        return true;
    }
}
