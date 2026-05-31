<?php

declare(strict_types=1);

namespace Mellow\Tests\Api\Freelancer;

use Mellow\Api\Freelancer\Freelancer;
use Mellow\Api\Freelancer\Parameter\FreelancerListParameters;
use Mellow\Api\Freelancer\Parameter\InviteParameters;
use Mellow\Api\Freelancer\Parameter\RemoveParameters;
use Mellow\Client;
use Mellow\ResponseConverter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;

#[CoversClass(Freelancer::class)]
class FreelancerTest extends TestCase
{
    private Freelancer|MockObject $api;

    protected function setUp(): void
    {
        $clientHttp = $this->createStub(ClientInterface::class);

        $client = Client::createWithHttpClient($clientHttp);

        $converter = $this->createStub(ResponseConverter::class);
        $converter->method('convert')->willReturn([]);

        $this->api = $this->getMockBuilder(Freelancer::class)
            ->onlyMethods(['delete', 'post', 'get'])
            ->setConstructorArgs([$client, $converter])
            ->getMock();
    }

    public function testInvite(): void
    {
        $this->api->expects($this->once())
            ->method('post')
            ->with('customer/freelancers', [
                'email' => 'test@example.com',
            ]);

        $parameters = (new InviteParameters())
            ->email('test@example.com');

        $this->api->invite($parameters);
    }

    public function testList(): void
    {
        $this->api->expects($this->once())
            ->method('get')
            ->with('customer/freelancers?page=2&size=25');

        $parameters = (new FreelancerListParameters())
            ->page(2)
            ->size(25);
        $this->api->list($parameters);
    }

    public function testRemove(): void
    {
        $this->api->expects($this->once())
            ->method('delete')
            ->with('customer/freelancers', [
                'freelancerId' => 1,
            ]);

        $parameters = (new RemoveParameters())
            ->freelancerId(1);
        $this->api->remove($parameters);
    }
}
