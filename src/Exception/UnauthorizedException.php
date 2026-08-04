<?php

declare(strict_types=1);

namespace Mellow\Exception;

final class UnauthorizedException extends ClientException
{
    public function __construct(
        string $message,
        int $code = 401,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
