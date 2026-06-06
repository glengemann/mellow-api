<?php

declare(strict_types=1);

namespace Mellow\Tests\Exception\Handler;

use Mellow\Exception\Handler\ForbiddenExceptionHandler;
use Mellow\Exception\Handler\NotFoundExceptionHandler;
use Mellow\Exception\Handler\UnauthorizedExceptionHandler;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(NotFoundExceptionHandler::class)]
class ForbiddenExceptionHandlerTest extends TestCase
{
    private ForbiddenExceptionHandler $handler;

    protected function setUp(): void
    {
        $this->handler = new ForbiddenExceptionHandler();
    }

    public static function provideData(): \Generator
    {
        yield [
            403,
            [
                'error' => 'Access Denied.',
            ],
            'Forbidden',
            'Access Denied.',
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
