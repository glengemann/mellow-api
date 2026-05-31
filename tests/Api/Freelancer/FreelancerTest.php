<?php

declare(strict_types=1);

namespace Mellow\Tests\Api\Freelancer;

use Mellow\Api\Freelancer\Freelancer;
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

        $this->api = $this->getMockBuilder(Freelancer::class)
            ->onlyMethods(['delete'])
            ->setConstructorArgs([$client, $converter])
            ->getMock();
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
