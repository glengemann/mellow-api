<?php

declare(strict_types=1);

namespace Mellow\Tests\Api\Freelancer;

use Mellow\Api\Freelancer\Freelancer;
use Mellow\Api\Freelancer\Parameter\FreelancerFilter;
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
            ->with('customer/freelancers?page=2&size=25&filter%5BisVerified%5D=1&filter%5BisInviteEmailSent%5D=0&filter%5BdateInvitedFrom%5D=2026-05-01&filter%5BdateInvitedTo%5D=2026-05-31');

        $parameters = (new FreelancerListParameters())
            ->page(2)
            ->size(25)
            ->filter(
                (new FreelancerFilter())
                    ->isVerified(true)
                    ->isInviteEmailSent(false)
                    ->dateInvitedFrom(new \DateTimeImmutable('2026-05-01'))
                    ->dateInvitedTo(new \DateTimeImmutable('2026-05-31'))
            );
        $this->api->list($parameters);
    }

    public function testFindByEmail(): void
    {
        $this->api->expects($this->once())
            ->method('get')
            ->with('customer/freelancer-by-email/test@example.com');

        $this->api->findByEmail('test@example.com');
    }

    public function testRetrieve(): void
    {
        $this->api->expects($this->once())
            ->method('get')
            ->with('customer/freelancers/1');

        $this->api->retrieve(1);
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
