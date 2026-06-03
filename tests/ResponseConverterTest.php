<?php

declare(strict_types=1);

namespace Mellow\Tests;

use Mellow\ResponseConverter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

#[CoversClass(ResponseConverter::class)]
class ResponseConverterTest extends TestCase
{
    private ResponseConverter $converter;

    public static function provideData(): \Generator
    {
        yield [
            422,
            '',
            '[422]',
        ];

        yield [
            422,
            '{"price":"Task price is too big. Max 10 000.00."}',
            '[422] Task price is too big. Max 10 000.00.',
        ];

        yield [
            422,
            '{"attributes": "Incorrect attribute value"}',
            '[422] {"attributes":"Incorrect attribute value"}',
        ];

        // @TODO: fix this test grap all errors
        yield [
            422,
            '{"workerId": "Worker not in team", "deadline": "Completion date must be later than current date at least by one day", "price": "A price cannot be less than \"0.01\""}',
            '[422] A price cannot be less than "0.01"',
        ];

        yield [
            422,
            '{"workerId": "Worker with id 1166115 not found"}',
            '[422] Worker with id 1166115 not found',
        ];
    }

    protected function setUp(): void
    {
        $this->converter = new ResponseConverter();
    }

    #[DataProvider('provideData')]
    public function testConvert(
        int $statusCode,
        string $body,
        string $expectedMessage,
    ): void {
        $response = $this->createStub(ResponseInterface::class);
        $response->method('getStatusCode')
            ->willReturn($statusCode);

        $stream = $this->createStub(StreamInterface::class);
        $stream->method('getContents')
            ->willReturn($body);

        $response->method('getBody')->willReturn($stream);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage($expectedMessage);

        $this->converter->convert($response, \stdClass::class);
    }
}
