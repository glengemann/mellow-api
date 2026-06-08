<?php

declare(strict_types=1);

namespace Mellow\Exception\Handler;

use Mellow\Exception\ApiException;
use Mellow\Exception\ValidationException;

class ValidationExceptionHandler implements ExceptionHandlerInterface
{
    public function supports(int $statusCode): bool
    {
        return 422 === $statusCode;
    }

    public function handle(int $statusCode, array $payload, array $headers): ApiException
    {
        return new ValidationException($payload);
    }
}
