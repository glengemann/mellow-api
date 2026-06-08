<?php

declare(strict_types=1);

namespace Mellow\Exception;

final class RateLimitException extends ClientException
{
    public function __construct(
        private readonly ?int $retryAfter,
        ?\Throwable $previous = null,
    ) {
        $message = 'Rate limit exceeded';

        parent::__construct($message, 429, $previous);
    }

    public function getRetryAfter(): ?int
    {
        return $this->retryAfter;
    }
}
