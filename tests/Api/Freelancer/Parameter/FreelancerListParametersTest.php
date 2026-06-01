<?php

declare(strict_types=1);

namespace Mellow\Tests\Api\Freelancer\Parameter;

use Mellow\Api\Freelancer\Parameter\FreelancerFilter;
use Mellow\Api\Freelancer\Parameter\FreelancerListParameters;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(FreelancerListParameters::class)]
class FreelancerListParametersTest extends TestCase
{
    private FreelancerListParameters $parameters;

    protected function setUp(): void
    {
        $this->parameters = new FreelancerListParameters();
    }

    public function testToArray(): void
    {
        $this->parameters
            ->page(2)
            ->size(25)
            ->filter(
                (new FreelancerFilter())
                    ->isVerified(true)
                    ->isInviteEmailSent(false)
                    ->dateInvitedFrom(new \DateTimeImmutable('2023-01-01'))
                    ->dateInvitedTo(new \DateTimeImmutable('2023-01-31'))
            );

        $expected = [
            'page' => 2,
            'size' => 25,
            'filter' => [
                'isVerified' => true,
                'isInviteEmailSent' => false,
                'dateInvitedFrom' => '2023-01-01',
                'dateInvitedTo' => '2023-01-31',
            ],
        ];
        $this->assertEquals($expected, $this->parameters->toArray());
    }

    public function testToArrayWithDefaults(): void
    {
        $expected = [];
        $this->assertEquals($expected, $this->parameters->toArray());
    }
}
