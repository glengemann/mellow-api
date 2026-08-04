<?php

declare(strict_types=1);

namespace Mellow\Api\Company\Response;

class DefaultResponse
{
    public function __construct(
        public string $token,
        public string $refreshToken,
    ) {
    }
}
