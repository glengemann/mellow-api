<?php

declare(strict_types=1);

namespace Mellow\Tests\Exception\Handler;

use Mellow\Exception\ConflictException;
use Mellow\Exception\Handler\ConflictExceptionHandler;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(ConflictExceptionHandler::class)]
class ConflictExceptionHandlerTest extends TestCase
{
    private ConflictExceptionHandler $handler;

    protected function setUp(): void
    {
        $this->handler = new ConflictExceptionHandler();
    }

    public static function provideData(): \Generator
    {
        yield [
            409,
            [
                'error' => 'The operating address for sales and use tax applies only to US-based companies. Your account is registered outside the United States, so no address is needed here.',
                'code' => 0,
            ],
            'The operating address for sales and use tax applies only to US-based companies. Your account is registered outside the United States, so no address is needed here.',
        ];
    }

    #[DataProvider('provideData')]
    public function testHandle(
        int $statusCode,
        array $body,
        string $expectedMessage,
    ): void {
        $actual = $this->handler->handle($statusCode, $body, []);

        $this->assertInstanceOf(ConflictException::class, $actual);
        $this->assertEquals($expectedMessage, $actual->getMessage());
    }
}
