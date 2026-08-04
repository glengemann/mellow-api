<?php

declare(strict_types=1);

namespace Mellow\Tests\Api\Company;

use Mellow\Api\Company\Company;
use Mellow\Api\Company\Parameter\OperatingAddressParameters;
use Mellow\Client;
use Mellow\ResponseConverter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

#[CoversClass(Company::class)]
class CompanyTest extends TestCase
{
    private Company|MockObject $api;

    protected function setUp(): void
    {
        $clientHttp = $this->createStub(ClientInterface::class);

        $client = Client::createWithHttpClient($clientHttp);

        $converter = $this->createStub(ResponseConverter::class);
        $converter->method('convert')->willReturnCallback(
            static fn (ResponseInterface $response, string $type): object => (new \ReflectionClass($type))
                ->newInstanceWithoutConstructor()
        );

        $this->api = $this->getMockBuilder(Company::class)
            ->onlyMethods(['post', 'get'])
            ->setConstructorArgs([$client, $converter])
            ->getMock();
    }

    public function testList(): void
    {
        $this->api->expects($this->once())
            ->method('get')
            ->with('customer/companies');

        $this->api->list();
    }

    public function testDefault(): void
    {
        $this->api->expects($this->once())
            ->method('post')
            ->with('customer/companies/1/default');

        $this->api->default(1);
    }

    public function testBalance(): void
    {
        $this->api->expects($this->once())
            ->method('get')
            ->with('customer/balance');

        $this->api->balance();
    }

    public function testSetOperatingAddress(): void
    {
        $this->api->expects($this->once())
            ->method('post')
            ->with('customer/companies/operating-address');

        $parameters = (new OperatingAddressParameters());

        $this->api->setOperatingAddress($parameters);
    }
}
