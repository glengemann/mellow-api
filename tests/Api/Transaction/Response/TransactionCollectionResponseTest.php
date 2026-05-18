<?php

declare(strict_types=1);

namespace Mellow\Tests\Api\Transaction\Response;

use Mellow\Api\Transaction\Response\TransactionCollectionResponse;
use Mellow\Api\Transaction\Response\TransactionCurrencyResponse;
use Mellow\Api\Transaction\Response\TransactionPaginationResponse;
use Mellow\Api\Transaction\Response\TransactionResponse;
use Mellow\Api\Transaction\Response\TransactionWorkerResponse;
use Mellow\ResponseConverter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

#[CoversClass(TransactionCollectionResponse::class)]
class TransactionCollectionResponseTest extends TestCase
{
    private ResponseConverter $converter;

    protected function setUp(): void
    {
        $this->converter = new ResponseConverter();
    }

    public function testFromArray(): void
    {
        $response = $this->createStub(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn(200);

        $stream = $this->createStub(StreamInterface::class);
        $stream->method('getContents')->willReturn(
            <<<JSON
        {
          "items": [
            {
              "id": 298891,
              "taskId": 110495,
              "type": 2,
              "amount": 359.28,
              "createdAt": "2026-05-14 19:10:03",
              "currency": {
                "currency": "USD",
                "id": 2
              },
              "taxRate": null,
              "balanceId": 804984,
              "worker": {
                "id": 100254730,
                "firstName": "John",
                "lastName": "Mock-Doe"
              },
              "invoiceId": null
            },
            {
              "id": 298889,
              "taskId": 110531,
              "type": 2,
              "amount": 271.68,
              "createdAt": "2026-05-11 16:09:49",
              "currency": {
                "currency": "USD",
                "id": 2
              },
              "taxRate": 7.5,
              "balanceId": 804984,
              "worker": {
                "id": 100254730,
                "firstName": "John",
                "lastName": "Mock-Doe"
              },
              "invoiceId": 42
            }
          ],
          "pagination": {
            "count": 2,
            "total": 2,
            "perPage": 20,
            "page": 1,
            "pages": 1
          }
        }
        JSON
        );

        $response->method('getBody')->willReturn($stream);
        $actual = $this->converter->convert($response, TransactionCollectionResponse::class);

        $expected = new TransactionCollectionResponse(
            [
                new TransactionResponse(
                    298891,
                    110495,
                    2,
                    359.28,
                    new \DateTimeImmutable('2026-05-14 19:10:03'),
                    new TransactionCurrencyResponse('USD', 2),
                    null,
                    804984,
                    new TransactionWorkerResponse(100254730, 'John', 'Mock-Doe'),
                    null,
                ),
                new TransactionResponse(
                    298889,
                    110531,
                    2,
                    271.68,
                    new \DateTimeImmutable('2026-05-11 16:09:49'),
                    new TransactionCurrencyResponse('USD', 2),
                    7.5,
                    804984,
                    new TransactionWorkerResponse(100254730, 'John', 'Mock-Doe'),
                    42,
                ),
            ],
            new TransactionPaginationResponse(
                2,
                2,
                20,
                1,
                1,
            )
        );
        $this->assertEquals($expected, $actual);
    }
}
