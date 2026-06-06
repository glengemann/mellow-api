<?php

declare(strict_types=1);

namespace Mellow\Tests\Exception\Handler;

use Mellow\Exception\Handler\RateLimitExceptionHandler;
use Mellow\Exception\RateLimitException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(RateLimitExceptionHandler::class)]
class RateLimitExceptionHandlerTest extends TestCase
{
    private RateLimitExceptionHandler $handler;

    public function setUp(): void
    {
        $this->handler = new RateLimitExceptionHandler();
    }

    public function testHandle(): void
    {
        $actual = $this->handler->handle(429, [], [
            'retry-after' => [
                '10',
            ],
        ]);

        $this->assertInstanceOf(RateLimitException::class, $actual);
        $this->assertEquals(10, $actual->getRetryAfter());
    }
}
