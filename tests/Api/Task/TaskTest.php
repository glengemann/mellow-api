<?php

declare(strict_types=1);

namespace Mellow\Tests\Api\Task;

use Mellow\Api\Task\Parameter\PublishDraftParameters;
use Mellow\Api\Task\Parameter\ResumeTaskParameters;
use Mellow\Api\Task\Task;
use Mellow\Client;
use Mellow\ResponseConverter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;

#[CoversClass(Task::class)]
class TaskTest extends TestCase
{
    private Task|MockObject $api;

    protected function setUp(): void
    {
        $clientHttp = $this->createStub(ClientInterface::class);

        $client = Client::createWithHttpClient($clientHttp);

        $converter = $this->createStub(ResponseConverter::class);

        $this->api = $this->getMockBuilder(Task::class)
            ->onlyMethods(['post'])
            ->setConstructorArgs([$client, $converter])
            ->getMock();
    }

    public function testResume(): void
    {
        $this->api->expects($this->once())
            ->method('post')
            ->with('customer/tasks/return-to-work', [
                'taskId' => 1,
            ]);

        $parameters = (new ResumeTaskParameters())
            ->taskId(1);
        $this->api->resume($parameters);
    }

    public function testPublish(): void
    {
        $this->api->expects($this->once())
            ->method('post')
            ->with('customer/tasks/publish-draft', [
                'taskId' => 1,
                'companyId' => 2,
            ]);

        $parameters = (new PublishDraftParameters())
            ->taskId(1)
            ->companyId(2);

        $this->api->publish($parameters);
    }
}
