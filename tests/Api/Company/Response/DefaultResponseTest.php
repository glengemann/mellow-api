<?php

declare(strict_types=1);

namespace Mellow\Tests\Api\Company\Response;

use Mellow\Api\Company\Response\DefaultResponse;
use Mellow\ResponseConverter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

#[CoversClass(DefaultResponse::class)]
class DefaultResponseTest extends TestCase
{
    private ResponseConverter $converter;

    protected function setUp(): void
    {
        $this->converter = new ResponseConverter();
    }

    public function testDefaultResponse(): void
    {
        $response = $this->createStub(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn(200);

        $stream = $this->createStub(StreamInterface::class);
        $stream->method('getContents')->willReturn('[]');

        $response->method('getBody')->willReturn($stream);

        $actual = $this->converter->convert($response, DefaultResponse::class);

        $this->assertInstanceOf(DefaultResponse::class, $actual);
    }
}
