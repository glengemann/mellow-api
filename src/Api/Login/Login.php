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
        ?int $code = null,
    ) {
        $url = 'login';

        $body = [
            'username' => $user,
            'password' => $password,
        ];

        if (null !== $code) {
            $body['code'] = (string) $code;
        }

        $response = $this->post($url, $body);

        return $this->responseConverter->convert($response, LoginResponse::class);
    }

    public function refresh(string $refreshToken)
    {
        $url = 'token/refresh';

        $response = $this->post($url, [
            'refreshToken' => $refreshToken,
        ]);

        return $this->responseConverter->convert($response, LoginResponse::class);
    }
}
