<?php

declare(strict_types=1);

namespace Mellow\Exception\Handler;

use Mellow\Exception\ApiException;
use Mellow\Exception\ForbiddenException;

class ForbiddenExceptionHandler implements ExceptionHandlerInterface
{
    public function support(int $statusCode): bool
    {
        return 403 === $statusCode;
    }

    public function handle(int $statusCode, array $payload, array $headers): ApiException
    {
        $error = $payload['error'] ?? null;

        return new ForbiddenException($error);
    }
}
