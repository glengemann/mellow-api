<?php

declare(strict_types=1);

namespace Mellow\Tests\Api\Profile\Response;

use Mellow\Api\Profile\Response\ProfileResponse;
use Mellow\ResponseConverter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

#[CoversClass(ProfileResponse::class)]
class ProfileResponseTest extends TestCase
{
    private ResponseConverter $converter;

    protected function setUp(): void
    {
        $this->converter = new ResponseConverter();
    }

    public function testProfileCreation(): void
    {
        $response = $this->createStub(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn(200);

        $stream = $this->createStub(StreamInterface::class);
        $stream->method('getContents')->willReturn(
            <<<JSON
           {
              "postCode": null,
              "physicalAddress": null,
              "city": null,
              "inn": null,
              "ip": "201.244.165.20",
              "birthDate": null,
              "gridsSettings": null,
              "loginNotification": false,
              "avatarFileId": null,
              "avatarFileUrl": null,
              "isRedesignEnabled": true,
              "showRedesignBanner": false,
              "id": 100254728,
              "uuid": "b1dd00c3-3cfb-42b5-afe6-23d541ae524f",
              "email": "operaciones@metrickal.com",
              "emailConfirmed": true,
              "username": "operaciones@metrickal.com",
              "firstName": null,
              "middleName": null,
              "lastName": null,
              "regDate": "2026-04-09",
              "twoFaMethod": "sms",
              "taxationStatus": 1,
              "phone": "34627442744",
              "phoneConfirmed": true,
              "country": "CY",
              "citizenship": null,
              "birthCountry": null,
              "state": null,
              "flags": 0,
              "type": "customer",
              "defaultSmsGate": null,
              "language": "EN",
              "isVerified": true,
              "typeVerified": 1,
              "specialization": null,
              "taxationBlockedTill": null,
              "selfEmployedLinkedAt": null,
              "shouldChangePassword": false,
              "altName": null,
              "russianInn": null,
              "languageStringValue": "EN",
              "name": "  "
            }
        JSON
        );

        $response->method('getBody')->willReturn($stream);

        $actual = $this->converter->convert($response, ProfileResponse::class);

        $expected = new ProfileResponse(
            postCode: null,
            physicalAddress: null,
            city: null,
            inn: null,
            ip: '201.244.165.20',
            birthDate: null,
            gridsSettings: null,
            loginNotification: false,
            avatarFileId: null,
            avatarFileUrl: null,
            isRedesignEnabled: true,
            showRedesignBanner: false,
            id: 100254728,
            uuid: 'b1dd00c3-3cfb-42b5-afe6-23d541ae524f',
            email: 'operaciones@metrickal.com',
            emailConfirmed: true,
            username: 'operaciones@metrickal.com',
            firstName: null,
            middleName: null,
            lastName: null,
            regDate: '2026-04-09',
            twoFaMethod: 'sms',
            taxationStatus: 1,
            phone: '34627442744',
            phoneConfirmed: true,
            country: 'CY',
            citizenship: null,
            birthCountry: null,
            state: null,
            flags: 0,
            type: 'customer',
            defaultSmsGate: null,
            language: 'EN',
            isVerified: true,
            typeVerified: 1,
            specialization: null,
            taxationBlockedTill: null,
            selfEmployedLinkedAt: null,
            shouldChangePassword: false,
            altName: null,
            russianInn: null,
            languageStringValue: 'EN',
            name: '  ',
        );

        $this->assertEquals($expected, $actual);
    }
}
