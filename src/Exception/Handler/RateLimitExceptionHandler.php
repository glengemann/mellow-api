<?php

declare(strict_types=1);

namespace Mellow\Exception\Handler;

use Mellow\Exception\ApiException;
use Mellow\Exception\RateLimitException;

class RateLimitExceptionHandler implements ExceptionHandlerInterface
{
    public function support(int $statusCode): bool
    {
        return 429 === $statusCode;
    }

    public function handle(int $statusCode, array $payload, array $headers): ApiException
    {
        $retryAfter = true === isset($headers['retry-after'][0])
            ? (int) $headers['retry-after'][0]
            : null;

        return new RateLimitException(
            $retryAfter,
        );
    }
}
