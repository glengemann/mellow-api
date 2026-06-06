<?php

declare(strict_types=1);

namespace Mellow\Tests\Exception\Handler;

use Mellow\Exception\Handler\NotFoundExceptionHandler;
use Mellow\Exception\Handler\UnauthorizedExceptionHandler;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(NotFoundExceptionHandler::class)]
class UnauthorizedExceptionHandlerTest extends TestCase
{
    private UnauthorizedExceptionHandler $handler;

    protected function setUp(): void
    {
        $this->handler = new UnauthorizedExceptionHandler();
    }

    public static function provideData(): \Generator
    {
        yield [
            401,
            [
                'error' => 'refresh_token_invalid',
                'code' => 0,
            ],
            'Unauthorized',
            'refresh_token_invalid',
        ];
    }

    #[DataProvider('provideData')]
    public function testHandle(
        int $statusCode,
        array $body,
        string $expectedMessage,
        string $expectedError,
    ): void {
        $actual = $this->handler->handle($statusCode, $body, []);

        $this->assertEquals($expectedMessage, $actual->getMessage());
        $this->assertEquals($expectedError, $actual->getError());
    }
}
