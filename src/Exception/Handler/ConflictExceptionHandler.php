<?php

declare(strict_types=1);

namespace Mellow\Exception\Handler;

use Mellow\Exception\ApiException;
use Mellow\Exception\ConflictException;

class ConflictExceptionHandler implements ExceptionHandlerInterface
{
    public function supports(int $statusCode): bool
    {
        return 409 === $statusCode;
    }

    public function handle(int $statusCode, array $payload, array $headers): ApiException
    {
        $error = $payload['error'] ?? 'Conflict';

        return new ConflictException($error);
    }
}
