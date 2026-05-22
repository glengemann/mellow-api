<?php

declare(strict_types=1);

namespace Mellow\Tests\Api\Company\Response;

use Mellow\Api\Company\Response\CompanyCollectionResponse;
use Mellow\Api\Company\Response\CompanyPaginationResponse;
use Mellow\Api\Company\Response\CompanyResponse;
use Mellow\ResponseConverter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

#[CoversClass(CompanyCollectionResponse::class)]
class CompanyCollectionResponseTest extends TestCase
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
          "items": [
            {
              "activated": true,
              "balanceVat": 0,
              "companyInitialInfoRequired": false,
              "profileCompleted": true,
              "id": 100000001,
              "uuid": "11111111-1111-4111-8111-111111111111",
              "companyName": "company_alpha",
              "brandName": "brand_alpha",
              "safeDealEnabled": false,
              "isDefault": true,
              "jurisdiction": 2,
              "balanceAmount": 1000000,
              "currency": {
                "currency": "EUR",
                "id": 3
              },
              "administratorId": 100000100,
              "statusId": 4,
              "edmInfo": {
                "operator": null,
                "subscriberId": null,
                "connectionDate": null
              },
              "country": "CY",
              "serviceFeeCompensationByDefault": false,
              "adminId": 100000100,
              "fullAddress": null,
              "fullPostAddress": null,
              "regNumber": null,
              "vat": "-",
              "contractNumber": "CNTR-ALPHA-001",
              "contractType": "oferta",
              "contractDate": "2026-01-10 09:00:00",
              "accountNumber": null,
              "limitMode": null,
              "employeesCountRange": null,
              "verificationStatus": "not_verified",
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
            },
            {
              "activated": true,
              "balanceVat": 0,
              "companyInitialInfoRequired": false,
              "profileCompleted": true,
              "id": 100000002,
              "uuid": "22222222-2222-4222-8222-222222222222",
              "companyName": "company_beta",
              "brandName": "brand_beta",
              "safeDealEnabled": true,
              "isDefault": false,
              "jurisdiction": 2,
              "balanceAmount": 992360.95,
              "currency": {
                "currency": "USD",
                "id": 2
              },
              "administratorId": 100000101,
              "statusId": 4,
              "edmInfo": {
                "operator": null,
                "subscriberId": null,
                "connectionDate": null
              },
              "country": "ES",
              "serviceFeeCompensationByDefault": false,
              "adminId": 100000101,
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
              "contractNumber": "CNTR-BETA-002",
              "contractType": "oferta",
              "contractDate": "2026-01-10 16:00:00",
              "accountNumber": null,
              "limitMode": null,
              "employeesCountRange": 2,
              "verificationStatus": "not_verified",
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
          ],
          "pagination": {
            "count": 2,
            "total": 2,
            "perPage": 20,
            "page": 1,
            "pages": 1
          }
        }
        JSON
        );

        $response->method('getBody')->willReturn($stream);

        $actual = $this->converter->convert($response, CompanyCollectionResponse::class);

        $expected = new CompanyCollectionResponse(
            [
                new CompanyResponse(
                    true,
                    100000001,
                    '11111111-1111-4111-8111-111111111111',
                    'company_alpha',
                    'brand_alpha',
                    true,
                    4,
                    'CY',
                    ['currency' => 'EUR', 'id' => 3],
                ),
                new CompanyResponse(
                    true,
                    100000002,
                    '22222222-2222-4222-8222-222222222222',
                    'company_beta',
                    'brand_beta',
                    false,
                    4,
                    'ES',
                    ['currency' => 'USD', 'id' => 2],
                ),
            ],
            new CompanyPaginationResponse(2, 2, 20, 1, 1)
        );

        $this->assertEquals($expected, $actual);
    }
}
