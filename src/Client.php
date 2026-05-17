<?php

declare(strict_types=1);

namespace Mellow;

use Http\Client\Common\HttpMethodsClientInterface;
use Mellow\Api\Company\Company;
use Mellow\Api\Freelancer\Freelancer;
use Mellow\Api\Login\Login;
use Mellow\Api\Lookup\Lookup;
use Mellow\Api\Task\Task;
use Mellow\Api\Webhook\Webhook;
use Mellow\HttpClient\Builder;
use Mellow\HttpClient\Plugin\AuthenticationPlugin;
use Mellow\HttpClient\Plugin\CompanyPlugin;
use Mellow\HttpClient\Plugin\RetryAuthenticationPlugin;
use Psr\Http\Client\ClientInterface;

class Client
{
    private Builder $httpClientBuilder;

    private function __construct(
        ?Builder $httpClientBuilder = null,
    ) {
        $this->httpClientBuilder = $httpClientBuilder ?? new Builder();
    }

    public static function createWithHttpClient(
        ClientInterface $httpClient,
    ): self {
        $builder = new Builder($httpClient);

        return new self($builder);
    }

    public function login(): Login
    {
        return new Login($this);
    }

    public function company(): Company
    {
        return new Company($this);
    }

    public function task(): Task
    {
        return new Task($this);
    }

    public function freelancer(): Freelancer
    {
        return new Freelancer($this);
    }

    public function lookup(): Lookup
    {
        return new Lookup($this);
    }

    public function webhook(): Webhook
    {
        return new Webhook($this);
    }

    public function authenticate(string $apiKey): AuthenticationPlugin
    {
        $authentication = new AuthenticationPlugin($apiKey);
        $this->httpClientBuilder->addPlugin($authentication);

        return $authentication;
    }

    public function setCompany(int $companyId): void
    {
        $company = new CompanyPlugin($companyId);
        $this->httpClientBuilder->addPlugin($company);
    }

    public function withRetryAuthentication(RetryAuthenticationPlugin $plugin): void
    {
        $this->httpClientBuilder->addPlugin($plugin);
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->httpClientBuilder->getHttpClient();
    }
}
