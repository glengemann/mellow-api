<?php

declare(strict_types=1);

namespace Mellow\Exception\Handler;

use Mellow\Exception\ApiException;

interface ExceptionHandlerInterface
{
    public function support(int $statusCode): bool;

    public function handle(int $statusCode, array $payload, array $headers): ApiException;
}
