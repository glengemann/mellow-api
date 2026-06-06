<?php

declare(strict_types=1);

namespace Mellow\Tests\Exception;

use Mellow\Exception\ApiExceptionFactory;
use Mellow\Exception\ClientException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ApiExceptionFactory::class)]
class ApiExceptionFactoryTest extends TestCase
{
    private ApiExceptionFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new ApiExceptionFactory([]);
    }

    public function testCreateUnauthorizedException(): void
    {
        $actual = $this->factory->fromResponse(
            409,
            [
                'error' => 'Country must be specified to sign the agreement.',
                'code' => 52,
            ],
            [],
        );

        $this->assertEquals(ClientException::class, $actual::class);
        $this->assertEquals('Country must be specified to sign the agreement.', $actual->getMessage());
        $this->assertEquals(409, $actual->getCode());
    }
}
