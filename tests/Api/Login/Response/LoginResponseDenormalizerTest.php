<?php

declare(strict_types=1);

namespace Mellow\Tests\Api\Login\Response;

use Mellow\Api\Login\Response\CredentialResponse;
use Mellow\Api\Login\Response\LoginResponse;
use Mellow\Api\Login\Response\TwoFactorEnabledResponse;
use Mellow\ResponseConverter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

#[CoversClass(CredentialResponse::class)]
class LoginResponseDenormalizerTest extends TestCase
{
    private ResponseConverter $converter;

    protected function setUp(): void
    {
        $this->converter = new ResponseConverter();
    }

    public static function provideData(): \Generator
    {
        yield 'credential' => [
            <<<JSON
            {
              "token": "token",
              "refreshToken": "refreshToken"
            }
            JSON,
            new CredentialResponse('token', 'refreshToken'),
        ];

        yield 'twoFactor' => [
            <<<JSON
            {
              "2FA": {
                "type": "SMS",
                "number": "+123456789"
              }
            }
            JSON,
            new TwoFactorEnabledResponse('SMS', '+123456789'),
        ];

        yield [
            <<<JSON
            {
              "2FA": {
                "type": "SMS",
                "number": null
              }
            }
            JSON,
            new TwoFactorEnabledResponse('SMS', null),
        ];
    }

    #[DataProvider('provideData')]
    public function testLoginCreation(string $json, $expected): void
    {
        $response = $this->createStub(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn(200);

        $stream = $this->createStub(StreamInterface::class);
        $stream->method('getContents')->willReturn($json);

        $response->method('getBody')->willReturn($stream);

        $response = $this->converter->convert($response, LoginResponse::class);

        $this->assertEquals($expected, $response);
    }
}
