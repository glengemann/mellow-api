<?php

declare(strict_types=1);

namespace Mellow\Exception;

final class ConflictException extends ClientException
{
    public function __construct(
        string $message,
        int $code = 409,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
