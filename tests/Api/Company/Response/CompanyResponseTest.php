<?php

declare(strict_types=1);

namespace Mellow\Tests\Api\Company\Response;

use Mellow\Api\Company\Response\CompanyResponse;
use Mellow\ResponseConverter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

#[CoversClass(CompanyResponse::class)]
class CompanyResponseTest extends TestCase
{
    private ResponseConverter $converter;

    protected function setUp(): void
    {
        $this->converter = new ResponseConverter();
    }

    public function testCompanyCreation(): void
    {
        $response = $this->createStub(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn(200);

        $stream = $this->createStub(StreamInterface::class);
        $stream->method('getContents')->willReturn(
            <<<JSON
            {
              "activated": true,
              "balanceVat": 0,
              "companyInitialInfoRequired": false,
              "profileCompleted": true,
              "id": 100000001,
              "uuid": "11111111-1111-4111-8111-111111111111",
              "companyName": "company_alpha",
              "brandName": "brand_alpha",
              "safeDealEnabled": true,
              "isDefault": true,
              "jurisdiction": 2,
              "balanceAmount": 1360.15,
              "currency": {
                "currency": "USD",
                "id": 2
              },
              "administratorId": 100000100,
              "statusId": 4,
              "edmInfo": {
                "operator": null,
                "subscriberId": null,
                "connectionDate": null
              },
              "country": "ES",
              "serviceFeeCompensationByDefault": false,
              "adminId": 100000100,
              "fullAddress": {
                "address": "00000, Example Street 1, Example City, Example Region, Spain",
                "city": "Example City",
                "region": "Example Region",
                "postalCode": "00000",
                "country": "ES"
              },
              "fullPostAddress": {
                "address": "00000, Example Street 1, Example City, Example Region, Spain",
                "city": "Example City",
                "region": "Example Region",
                "postalCode": "00000",
                "country": "ES"
              },
              "regNumber": "REG-00000001",
              "vat": "ESREG00000001",
              "contractNumber": "CNTR-ALPHA-001",
              "contractType": "oferta",
              "contractDate": "2026-01-10 09:00:00",
              "accountNumber": null,
              "limitMode": null,
              "employeesCountRange": 2,
              "verificationStatus": "verified",
              "actions": [
                {
                  "id": "inviteFreelancers"
                },
                {
                  "id": "createNewTasks"
                },
                {
                  "id": "importTasks"
                }
              ]
            }
            JSON
        );

        $response->method('getBody')->willReturn($stream);

        $actual = $this->converter->convert($response, CompanyResponse::class);

        $expected = new CompanyResponse(
            true,
            100000001,
            '11111111-1111-4111-8111-111111111111',
            'company_alpha',
            'brand_alpha',
            true,
            4,
            'ES',
            ['currency' => 'USD', 'id' => 2],
        );

        $this->assertEquals($expected, $actual);
    }
}
