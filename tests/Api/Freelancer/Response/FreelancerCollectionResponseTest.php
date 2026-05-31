<?php

declare(strict_types=1);

namespace Mellow\Tests\Api\Freelancer\Response;

use Mellow\Api\Freelancer\Response\FreelancerCollectionResponse;
use Mellow\Api\Freelancer\Response\FreelancerPaginationResponse;
use Mellow\Api\Freelancer\Response\FreelancerResponse;
use Mellow\ResponseConverter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

#[CoversClass(FreelancerCollectionResponse::class)]
class FreelancerCollectionResponseTest extends TestCase
{
    private ResponseConverter $converter;

    protected function setUp(): void
    {
        $this->converter = new ResponseConverter();
    }

    public function testFreelancerCreation(): void
    {
        $response = $this->createStub(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn(200);

        $stream = $this->createStub(StreamInterface::class);
        $stream->method('getContents')->willReturn(
            <<<JSON
        {
          "items": [
            {
              "id": 1,
              "uuid": "00000000-0000-0000-0000-000000000001",
              "email": "freelancer1@example.test",
              "name": "Test User One",
              "taxationStatusId": 1,
              "taxationBlockedTill": null,
              "categoryTitle": null,
              "categoryTitleEn": null,
              "details": {
                "firstName": "",
                "lastName": "",
                "note": "",
                "specialization": ""
              },
              "isVerified": false,
              "country": null,
              "isInviteSent": false,
              "inviteSentAt": "2026-05-28 23:06:04",
              "actualRegDate": null,
              "dateVerified": null,
              "isRegistered": false,
              "isTaxPaymentAllowed": false,
              "emailConfirmationStatus": 0,
              "phoneConfirmationStatus": 0,
              "phone": null
            },
            {
              "id": 2,
              "uuid": "00000000-0000-0000-0000-000000000002",
              "email": "freelancer2@example.test",
              "name": "Test User Two",
              "taxationStatusId": 1,
              "taxationBlockedTill": null,
              "categoryTitle": null,
              "categoryTitleEn": null,
              "details": {
                "firstName": "",
                "lastName": "",
                "note": "",
                "specialization": ""
              },
              "isVerified": false,
              "country": null,
              "isInviteSent": false,
              "inviteSentAt": "2026-05-28 23:06:03",
              "actualRegDate": null,
              "dateVerified": null,
              "isRegistered": false,
              "isTaxPaymentAllowed": false,
              "emailConfirmationStatus": 0,
              "phoneConfirmationStatus": 0,
              "phone": null
            }
          ],
          "pagination": {
            "count": 2,
            "total": 2,
            "perPage": 2,
            "page": 1,
            "pages": 1
          }
        }
        JSON
        );

        $response->method('getBody')->willReturn($stream);

        $actual = $this->converter->convert($response, FreelancerCollectionResponse::class);

        $expected = new FreelancerCollectionResponse(
            [
                new FreelancerResponse(
                    1,
                    '00000000-0000-0000-0000-000000000001',
                    'freelancer1@example.test',
                    'Test User One',
                    1,
                    null,
                    null,
                    null,
                    [
                        'firstName' => '',
                        'lastName' => '',
                        'note' => '',
                        'specialization' => '',
                    ],
                    false,
                    null,
                    false,
                    new \DateTimeImmutable('2026-05-28 23:06:04'),
                    null,
                    null,
                    false,
                    false,
                    0,
                    0,
                    null
                ),
                new FreelancerResponse(
                    2,
                    '00000000-0000-0000-0000-000000000002',
                    'freelancer2@example.test',
                    'Test User Two',
                    1,
                    null,
                    null,
                    null,
                    [
                        'firstName' => '',
                        'lastName' => '',
                        'note' => '',
                        'specialization' => '',
                    ],
                    false,
                    null,
                    false,
                    new \DateTimeImmutable('2026-05-28 23:06:03'),
                    null,
                    null,
                    false,
                    false,
                    0,
                    0,
                    null
                ),
            ],
            new FreelancerPaginationResponse(
                2,
                2,
                2,
                1,
                1
            )
        );

        $this->assertEquals($expected, $actual);
    }
}
