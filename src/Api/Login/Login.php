<?php

declare(strict_types=1);

namespace Mellow\Api\Login;

use Mellow\Api\AbstractApi;
use Mellow\Api\Login\Response\LoginResponse;

class Login extends AbstractApi
{
    public function login(
        string $user,
        #[\SensitiveParameter]
        string $password,
        int $code = 0,
    ) {
        $url = 'login';

        $response = $this->post($url, [
            'username' => $user,
            'password' => $password,
            'code' => $code,
        ]);

        return $this->responseConverter->convert($response, LoginResponse::class);
    }

    public function refresh(string $refreshToken)
    {
        $url = 'refresh';

        $response = $this->post($url, [
            'refreshToken' => $refreshToken,
        ]);

        return $this->responseConverter->convert($response, LoginResponse::class);
    }
}
