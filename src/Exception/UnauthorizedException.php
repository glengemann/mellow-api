<?php

declare(strict_types=1);

namespace Mellow\Exception;

final class UnauthorizedException extends ClientException
{
    public function __construct(
        private readonly string $error,
        int $code = 401,
        ?\Throwable $previous = null,
    ) {
        parent::__construct('Unauthorized', $code, $previous);
    }

    public function getError(): string
    {
        return $this->error;
    }
}
