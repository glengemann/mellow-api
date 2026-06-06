<?php

declare(strict_types=1);

namespace Mellow\Exception;

use Mellow\Exception\Handler\ExceptionHandlerInterface;
use Mellow\Exception\Handler\ForbiddenExceptionHandler;
use Mellow\Exception\Handler\NotFoundExceptionHandler;
use Mellow\Exception\Handler\RateLimitExceptionHandler;
use Mellow\Exception\Handler\ServerExceptionHandler;
use Mellow\Exception\Handler\UnauthorizedExceptionHandler;
use Mellow\Exception\Handler\ValidationExceptionHandler;

class ApiExceptionFactory
{
    /** @var ExceptionHandlerInterface[] */
    private array $handers = [];

    public function __construct(
        ?array $handers = null,
    ) {
        $this->handers = $handers ?? [
            new UnauthorizedExceptionHandler(),
            new ValidationExceptionHandler(),
            new RateLimitExceptionHandler(),
            new NotFoundExceptionHandler(),
            new ServerExceptionHandler(),
            new ForbiddenExceptionHandler(),
        ];
    }

    public function fromResponse(
        int $statusCode,
        array $payload,
        array $headers,
    ): ApiException {
        foreach ($this->handers as $handler) {
            if ($handler->support($statusCode)) {
                return $handler->handle($statusCode, $payload, $headers);
            }
        }

        $message = $payload['error'] ?? $payload['message'] ?? 'Client error.';

        return new ClientException($message, $statusCode);
    }
}
