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
        ?array $additionalHandlers = [],
    ) {
        $this->handers = [
            ...$additionalHandlers,
            new UnauthorizedExceptionHandler(),
            new ForbiddenExceptionHandler(),
            new NotFoundExceptionHandler(),
            new ValidationExceptionHandler(),
            new RateLimitExceptionHandler(),
            new ServerExceptionHandler(),
        ];
    }

    public function fromResponse(
        int $statusCode,
        array $payload,
        array $headers,
    ): ApiException {
        foreach ($this->handers as $handler) {
            if ($handler->supports($statusCode)) {
                return $handler->handle($statusCode, $payload, $headers);
            }
        }

        $message = $payload['error'] ?? $payload['message'] ?? 'Client error.';

        return new ClientException($message, $statusCode);
    }
}
