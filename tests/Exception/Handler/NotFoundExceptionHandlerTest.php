<?php

declare(strict_types=1);

namespace Mellow\Tests\Exception\Handler;

use Mellow\Exception\Handler\NotFoundExceptionHandler;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(NotFoundExceptionHandler::class)]
class NotFoundExceptionHandlerTest extends TestCase
{
    private NotFoundExceptionHandler $handler;

    protected function setUp(): void
    {
        $this->handler = new NotFoundExceptionHandler();
    }

    public static function provideData(): \Generator
    {
        yield [
            404,
            [
                'error' => 'TaskItemView with ID 1fd50d9d-d85d-4aad-a025-5f106bd068ca was not found',
                'code' => 0,
            ],
            'TaskItemView with ID 1fd50d9d-d85d-4aad-a025-5f106bd068ca was not found',
        ];

        yield [
            404,
            [],
            'Not Found',
        ];
    }

    #[DataProvider('provideData')]
    public function testHandle(
        int $statusCode,
        array $body,
        string $expectedMessage,
    ): void {
        $actual = $this->handler->handle($statusCode, $body, []);

        $this->assertEquals($expectedMessage, $actual->getMessage());
    }
}
