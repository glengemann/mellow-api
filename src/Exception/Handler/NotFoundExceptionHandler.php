<?php

declare(strict_types=1);

namespace Mellow\Exception\Handler;

use Mellow\Exception\ApiException;
use Mellow\Exception\NotFoundException;

class NotFoundExceptionHandler implements ExceptionHandlerInterface
{
    public function supports(int $statusCode): bool
    {
        return 404 === $statusCode;
    }

    public function handle(int $statusCode, array $payload, array $headers): ApiException
    {
        $message = $payload['error'] ?? 'Not Found';

        return new NotFoundException($message);
    }
}
