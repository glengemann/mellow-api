<?php

declare(strict_types=1);

namespace Mellow\Tests\Exception\Handler;

use Mellow\Exception\Handler\ValidationExceptionHandler;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(ValidationExceptionHandler::class)]
class ValidationExceptionHandlerTest extends TestCase
{
    private ValidationExceptionHandler $handler;

    protected function setUp(): void
    {
        $this->handler = new ValidationExceptionHandler();
    }

    public static function provideData(): \Generator
    {
        yield [
            422,
            [],
            'The request is invalid',
            [],
        ];

        yield [
            422,
            ['price' => 'Task price is too big. Max 10 000.00.'],
            'The request is invalid',
            ['price' => 'Task price is too big. Max 10 000.00.'],
        ];

        yield [
            422,
            ['attributes' => 'Incorrect attribute value'],
            'The request is invalid',
            ['attributes' => 'Incorrect attribute value'],
        ];

        yield [
            422,
            [
                'workerId' => 'Worker not in team',
                'deadline' => 'Completion date must be later than current date at least by one day',
                'price' => 'A price cannot be less than "0.01"',
            ],
            'The request is invalid',
            ['workerId' => 'Worker not in team', 'deadline' => 'Completion date must be later than current date at least by one day', 'price' => 'A price cannot be less than "0.01"'],
        ];

        yield [
            422,
            ['workerId' => 'Worker with id 1166115 not found'],
            'The request is invalid',
            ['workerId' => 'Worker with id 1166115 not found'],
        ];

        yield [
            422,
            ['taskId' => 'Can not process task with current state'],
            'The request is invalid',
            ['taskId' => 'Can not process task with current state'],
        ];

        yield [
            422,
            ['error' => 'Contractor not found'],
            'The request is invalid',
            ['error' => 'Contractor not found'],
        ];

        yield [
            422,
            ['error' => 'Worker have not finished tasks.'],
            'The request is invalid',
            ['error' => 'Worker have not finished tasks.'],
        ];
    }

    #[DataProvider('provideData')]
    public function testHandle(
        int $statusCode,
        array $body,
        string $expectedMessage,
        array $errors,
    ): void {
        $actual = $this->handler->handle($statusCode, $body, []);

        $this->assertEquals($expectedMessage, $actual->getMessage());
        $this->assertEquals($errors, $actual->getErrors());
    }
}
