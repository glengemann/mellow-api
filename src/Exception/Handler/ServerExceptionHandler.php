<?php

declare(strict_types=1);

namespace Mellow\Exception\Handler;

use Mellow\Exception\ApiException;
use Mellow\Exception\ServerException;

class ServerExceptionHandler implements ExceptionHandlerInterface
{
    public function supports(int $statusCode): bool
    {
        return 500 <= $statusCode;
    }

    public function handle(int $statusCode, array $payload, array $headers): ApiException
    {
        $message = $payload['error'] ?? $payload['message'] ?? 'Server Error.';

        return new ServerException($message);
    }
}
