<?php

declare(strict_types=1);

namespace Mellow\Exception\Handler;

use Mellow\Exception\ApiException;
use Mellow\Exception\UnauthorizedException;

class UnauthorizedExceptionHandler implements ExceptionHandlerInterface
{
    public function supports(int $statusCode): bool
    {
        return 401 === $statusCode;
    }

    public function handle(int $statusCode, array $payload, array $headers): ApiException
    {
        $error = $payload['error'] ?? null;

        return new UnauthorizedException($error);
    }
}
