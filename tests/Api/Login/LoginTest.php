<?php

declare(strict_types=1);

namespace Mellow\Tests\Api\Login;

use Mellow\Api\Login\Login;
use Mellow\Client;
use Mellow\ResponseConverter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;

#[CoversClass(Login::class)]
class LoginTest extends TestCase
{
    private readonly Login|MockObject $api;

    protected function setUp(): void
    {
        $httpClient = $this->createStub(ClientInterface::class);
        $client = Client::createWithHttpClient($httpClient);

        $converter = $this->createStub(ResponseConverter::class);

        $this->api = $this->getMockBuilder(Login::class)
            ->onlyMethods(['post'])
            ->setConstructorArgs([$client, $converter])
            ->getMock();
    }

    public function testLogin(): void
    {
        $this->api->expects($this->once())
            ->method('post')
            ->with('login', [
                'username' => 'username',
                'password' => 'password',
            ]);

        $this->api->login('username', 'password');
    }

    public function testLoginWithTwoFactorAuth(): void
    {
        $this->api->expects($this->once())
            ->method('post')
            ->with('login', [
                'username' => 'username',
                'password' => 'password',
                'code' => '123456',
            ]);

        $this->api->login('username', 'password', 123456);
    }

    public function testRefresh(): void
    {
        $this->api->expects($this->once())
            ->method('post')
            ->with('token/refresh', ['refreshToken' => 'refreshToken']);

        $this->api->refresh('refreshToken');
    }
}
