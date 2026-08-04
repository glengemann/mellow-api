<?php

declare(strict_types=1);

namespace Mellow\Tests\Api\Company\Response;

use Mellow\Api\Company\Response\BalanceResponse;
use Mellow\ResponseConverter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

#[CoversClass(BalanceResponse::class)]
class BalanceResponseTest extends TestCase
{
    private ResponseConverter $converter;

    protected function setUp(): void
    {
        $this->converter = new ResponseConverter();
    }

    public static function provideData(): \Generator
    {
        yield [
            <<<JSON
            {
              "currency": {
                "currency": "USD",
                "id": 1
              },
              "id": 234,
              "showVat": false,
              "balanceAmount": 1000.45,
              "balanceAmountVat": 0,
              "holdAmount": 500.5,
              "holdAmountVat": 0,
              "toPayAmount": 0,
              "toPayAmountVat": 0
            }
            JSON,
            new BalanceResponse(
                ['currency' => 'USD', 'id' => 1],
                234,
                false,
                1000.45,
                0,
                500.5,
                0,
                0,
                0,
            ),
        ];
    }

    #[DataProvider('provideData')]
    public function testBalanceCreation(string $json, BalanceResponse $expected): void
    {
        $response = $this->createStub(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn(200);

        $stream = $this->createStub(StreamInterface::class);
        $stream->method('getContents')->willReturn($json);

        $response->method('getBody')->willReturn($stream);

        $actual = $this->converter->convert($response, BalanceResponse::class);

        $this->assertEquals($expected, $actual);
    }
}
