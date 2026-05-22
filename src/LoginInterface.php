<?php

declare(strict_types=1);

namespace Mellow;

use Mellow\Api\Login\Response\LoginResponse;

interface LoginInterface
{
    public function login(?int $twoFactorCode = null): LoginResponse;
}
