<?php

declare(strict_types=1);

namespace Mellow\Exception;

class ValidationException extends ClientException
{
    public function __construct(
        private readonly array $errors,
        int $code = 422,
        ?\Throwable $previous = null,
    ) {
        parent::__construct('The request is invalid', $code, $previous);
    }

    /** @return array<string, string> */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
