<?php

declare(strict_types=1);

namespace Mellow\Tests;

use Mellow\ResponseConverter;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ResponseConverterTest extends TestCase
{
    private ResponseConverter $converter;

    protected function setUp(): void
    {
        $this->converter = new ResponseConverter();
    }

    public function testConvert(): void
    {
        $response = $this->createStub(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn(422);

        $stream = $this->createStub(StreamInterface::class);
        $stream->method('getContents')->willReturn(<<<JSON
        {"price":"Task price is too big. Max 10 000.00."}
        JSON);

        $response->method('getBody')->willReturn($stream);

        $response = $this->converter->convert($response, \stdClass::class);
    }
}
