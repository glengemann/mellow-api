<?php

declare(strict_types=1);

namespace Mellow\Api\Login\Response;

interface LoginResponse
{
    public function requiresTwoFactor(): bool;
}
