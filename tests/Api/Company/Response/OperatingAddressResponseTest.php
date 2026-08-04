<?php

declare(strict_types=1);

namespace Mellow\Tests\Api\Company\Response;

use Mellow\Api\Company\Response\OperatingAddressResponse;
use Mellow\ResponseConverter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

#[CoversClass(OperatingAddressResponse::class)]
class OperatingAddressResponseTest extends TestCase
{
    private ResponseConverter $converter;

    protected function setUp(): void
    {
        $this->converter = new ResponseConverter();
    }

    public function testOperatingAddressResponse(): void
    {
        $response = $this->createStub(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn(200);

        $stream = $this->createStub(StreamInterface::class);
        $stream->method('getContents')->willReturn('[]');

        $response->method('getBody')->willReturn($stream);

        $actual = $this->converter->convert($response, OperatingAddressResponse::class);

        $this->assertInstanceOf(OperatingAddressResponse::class, $actual);
    }
}
