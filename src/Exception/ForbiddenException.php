<?php

declare(strict_types=1);

namespace Mellow\Exception;

final class ForbiddenException extends ClientException
{
    public function __construct(
        private readonly ?string $error,
        int $code = 403,
        ?\Throwable $previous = null,
    ) {
        $message = 'Forbidden';

        parent::__construct($message, $code, $previous);
    }

    public function getError(): ?string
    {
        return $this->error;
    }
}
