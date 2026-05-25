<?php

declare(strict_types=1);

namespace Mellow\Tests\Api\Lookup\Response;

use Mellow\Api\Lookup\Response\ServiceCollectionResponse;
use Mellow\Api\Lookup\Response\ServicePaginationResponse;
use Mellow\Api\Lookup\Response\ServiceResponse;
use Mellow\ResponseConverter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

#[CoversClass(ServiceCollectionResponse::class)]
class ServiceCollectionResponseTest extends TestCase
{
    private ResponseConverter $converter;

    protected function setUp(): void
    {
        $this->converter = new ResponseConverter();
    }

    public function testServiceCreation(): void
    {
        $response = $this->createStub(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn(200);

        $stream = $this->createStub(StreamInterface::class);
        $stream->method('getContents')->willReturn(
            <<<JSON
        {
          "items": [
            {
              "id": 3074,
              "title": "3D моделирование",
              "titleEn": "3D modeling",
              "titleDoc": "3D моделирование",
              "titleDocEn": "3D modeling"
            },
            {
              "id": 3075,
              "title": "SEO оптимизация",
              "titleEn": "SEO",
              "titleDoc": "SEO оптимизация",
              "titleDocEn": "SEO"
            }
          ],
          "pagination": {
            "count": 2,
            "total": 173,
            "perPage": 2,
            "page": 1,
            "pages": 87
          }
        }
        JSON
        );

        $response->method('getBody')->willReturn($stream);

        $actual = $this->converter->convert($response, ServiceCollectionResponse::class);

        $expected = new ServiceCollectionResponse(
            [
                new ServiceResponse(
                    3074,
                    '3D моделирование',
                    '3D modeling',
                    '3D моделирование',
                    '3D modeling',
                ),
                new ServiceResponse(
                    3075,
                    'SEO оптимизация',
                    'SEO',
                    'SEO оптимизация',
                    'SEO',
                ),
            ],
            new ServicePaginationResponse(
                2,
                173,
                2,
                1,
                87,
            )
        );

        $this->assertEquals($expected, $actual);
    }
}
