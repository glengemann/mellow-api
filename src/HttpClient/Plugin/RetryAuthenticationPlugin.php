<?php

declare(strict_types=1);

namespace Mellow\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Mellow\Api\Login\Login;
use Mellow\Store\TokenStoreInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class RetryAuthenticationPlugin implements Plugin
{
    public function __construct(
        private readonly AuthenticationPlugin $authPlugin,
        private readonly Login $loginApi,
        private readonly TokenStoreInterface $tokenStore,
        private readonly string $username,
        #[\SensitiveParameter]
        private readonly string $password,
    ) {
    }

    /**
     * @param callable(RequestInterface): Promise $next Next middleware in the chain, the request is passed as the first argument
     * @param callable(RequestInterface): Promise $first First middleware in the chain, used to to restart a request
     */
    public function handleRequest(
        RequestInterface $request,
        callable $next,
        callable $first,
    ): Promise {
        return $next($request)
            ->then(function (ResponseInterface $response) use ($request, $first): ResponseInterface|Promise {
                if (401 !== $response->getStatusCode()) {
                    return $response;
                }

                $newToken = $this->reAuthenticate();
                $this->authPlugin->updateToken($newToken);

                return $first($request)->wait();
            });
    }

    private function reAuthenticate(): string
    {
        if (null !== $refreshToken = $this->tokenStore->getRefreshToken()) {
            try {
                $credentials = $this->loginApi->refresh($refreshToken);
                $this->tokenStore->save($credentials->token, $credentials->refreshToken);

                return $credentials->token;
            } catch (\Throwable) {
            }
        }

        $this->tokenStore->delete();

        $credentials = $this->loginApi->login($this->username, $this->password);
        $this->tokenStore->save($credentials->token, $credentials->refreshToken);

        return $credentials->token;
    }
}
