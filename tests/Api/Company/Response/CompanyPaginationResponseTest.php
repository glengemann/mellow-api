<?php

declare(strict_types=1);

namespace Mellow\Tests\Api\Company\Response;

use Mellow\Api\Company\Response\CompanyPaginationResponse;
use Mellow\ResponseConverter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

#[CoversClass(CompanyPaginationResponse::class)]
class CompanyPaginationResponseTest extends TestCase
{
    private ResponseConverter $converter;

    protected function setUp(): void
    {
        $this->converter = new ResponseConverter();
    }

    public function testPaginationCreation(): void
    {
        $response = $this->createStub(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn(200);

        $stream = $this->createStub(StreamInterface::class);
        $stream->method('getContents')->willReturn(
            <<<JSON
            {
              "count": 2,
              "total": 2,
              "perPage": 20,
              "page": 1,
              "pages": 1
            }
            JSON
        );

        $response->method('getBody')->willReturn($stream);

        $actual = $this->converter->convert($response, CompanyPaginationResponse::class);

        $expected = new CompanyPaginationResponse(2, 2, 20, 1, 1);

        $this->assertEquals($expected, $actual);
    }
}
