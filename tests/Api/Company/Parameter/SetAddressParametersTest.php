<?php

declare(strict_types=1);

namespace Mellow\Tests\Api\Company\Parameter;

use Mellow\Api\Company\Parameter\OperatingAddressParameters;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(OperatingAddressParameters::class)]
class SetAddressParametersTest extends TestCase
{
    private OperatingAddressParameters $parameters;

    protected function setUp(): void
    {
        $this->parameters = new OperatingAddressParameters();
    }

    public function testToArray(): void
    {
        $this->parameters
            ->address('350 Fifth Avenue')
            ->city('New York')
            ->state('NY')
            ->zipCode('10118')
            ->country('US');

        $expected = [
            'address' => '350 Fifth Avenue',
            'city' => 'New York',
            'state' => 'NY',
            'zipCode' => '10118',
            'country' => 'US',
        ];

        $this->assertEquals($expected, $this->parameters->toArray());
    }

    public function testToArrayWithDefaults(): void
    {
        $this->assertEquals([], $this->parameters->toArray());
    }
}
