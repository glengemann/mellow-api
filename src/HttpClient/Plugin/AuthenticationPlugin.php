<?php

declare(strict_types=1);

namespace Mellow\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;

class AuthenticationPlugin implements Plugin
{
    public function __construct(
        private string $apiKey,
    ) {
    }

    public function updateToken(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    public function handleRequest(
        RequestInterface $request,
        callable $next,
        callable $first,
    ): Promise {
        $value = sprintf('Bearer %s', $this->apiKey);
        $request = $request->withHeader('Authorization', $value);

        return $next($request);
    }
}
