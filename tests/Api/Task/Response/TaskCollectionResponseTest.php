<?php

declare(strict_types=1);

namespace Mellow\Tests\Api\Task\Response;

use Mellow\Api\Task\Response\TaskCollectionResponse;
use Mellow\Api\Task\Response\TaskPaginationResponse;
use Mellow\Api\Task\Response\TaskResponse;
use Mellow\ResponseConverter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

#[CoversClass(TaskCollectionResponse::class)]
class TaskCollectionResponseTest extends TestCase
{
    private ResponseConverter $converter;

    protected function setUp(): void
    {
        $this->converter = new ResponseConverter();
    }

    public function testTaskCreation(): void
    {
        $response = $this->createStub(ResponseInterface::class);
        $response->method('getStatusCode')->willReturn(200);

        $stream = $this->createStub(StreamInterface::class);
        $stream->method('getContents')->willReturn(<<<JSON
        {
          "items": [
            {
              "attributes": [
                {
                  "id": 7840,
                  "title": "Количество",
                  "titleEn": "Quantity",
                  "description": "Работа в количественном выражении (любая единица измерения)",
                  "descriptionEn": "Use any unit of measurement",
                  "type": "text",
                  "attrTypeId": 9,
                  "values": [
                    {
                      "title": "1"
                    }
                  ]
                },
                {
                  "id": 7841,
                  "title": "Дата\/Период",
                  "titleEn": "Date\/Period",
                  "description": "Дата или период оказания услуги",
                  "descriptionEn": "Date or period of rendering the service",
                  "type": "text",
                  "attrTypeId": 49,
                  "values": [
                    {
                      "title": "07\/05\/2026 a 08\/05\/2026"
                    }
                  ]
                },
                {
                  "id": 7843,
                  "title": "Регион\/Адрес",
                  "titleEn": "Region\/Address",
                  "description": "Место оказания услуги",
                  "descriptionEn": "Location of the service",
                  "type": "text",
                  "attrTypeId": 35,
                  "values": [
                    {
                      "title": "CO"
                    }
                  ]
                }
              ],
              "messages": [],
              "creator": {
                "id": 100254728,
                "uuid": "b1dd00c3-3cfb-42b5-afe6-23d541ae524f",
                "fullName": " ",
                "language": "EN"
              },
              "worker": {
                "name": "John Mock-Doe",
                "id": 100254730,
                "email": "guillermo.lengemann@gmail.com",
                "firstName": "John",
                "lastName": "Mock-Doe",
                "isVerified": true,
                "category": {
                  "title": "Веб-разработчик",
                  "titleEn": "Web developer"
                },
                "taxationStatus": 1,
                "about": "",
                "uuid": "651dc34d-291a-4ba6-a92a-70003b705f1d",
                "country": {
                  "name": "Колумбия",
                  "nameEn": "Colombia",
                  "iso": "CO"
                }
              },
              "payer": {
                "id": 0,
                "fullName": " "
              },
              "files": [],
              "links": [],
              "agreementFileLink": null,
              "messageCount": 0,
              "group": null,
              "token": "MGU5MWE5OWEtNjljYy00NmIyLTgzOTQtYmVjYTk1MTAyNzdh",
              "actions": [],
              "additionalAttributes": null,
              "service": {
                "id": 3162,
                "title": "Услуги веб-разработчика",
                "titleEn": "Web developer services",
                "titleDoc": "Услуги веб-разработчика",
                "titleDocEn": "Web developer services"
              },
              "category": {
                "id": 310,
                "title": "Список услуг",
                "titleEn": "List of services",
                "type": 2
              },
              "commissionAmount": 2.27,
              "commissionAmountInWorkerCurrency": 2.27,
              "commissionPercent": 3.5,
              "copyright": false,
              "createType": "API_2",
              "companyId": 100001385,
              "currency": {
                "currency": "USD",
                "id": 2
              },
              "workerCurrency": {
                "currency": "USD",
                "id": 2
              },
              "customer": {
                "id": 100001385,
                "title": "Impacter3.0 S.L."
              },
              "dateCreated": "2026-05-20 20:24:36",
              "dateAccepted": null,
              "dateEnd": "2026-05-23 22:24:30",
              "dateFinished": null,
              "datePaid": null,
              "datePayAt": null,
              "documentDate": null,
              "description": "Proyecto 882 Web developer services. Tasa de cambio COP\/USD 3795.98.",
              "id": 110622,
              "uuid": "0e91a99a-69cc-46b2-8394-beca9510277a",
              "needReport": false,
              "price": 64.81,
              "priceInWorkerCurrency": 64.81,
              "state": 2,
              "merchantId": null,
              "title": "Proyecto 882 Web developer services",
              "deadline": {
                "type": 1,
                "triggerDate": "2026-05-23 22:24:30",
                "isComingUp": true
              },
              "hold": {
                "type": "on_task_create",
                "isActive": true
              },
              "insurance": {
                "status": 1,
                "cost": 0
              },
              "activeDispute": null,
              "activeChangesetId": null,
              "vat": 0,
              "fullPriceWithVAT": 67.08,
              "insuranceCost": 0,
              "issueCode": null,
              "offerTaskId": null,
              "hasPayout": false,
              "priceWithCommission": 67.08,
              "serviceFeeCompensation": 0,
              "serviceFeeCompensationPercent": 0,
              "reportId": null,
              "shareCommission": false,
              "sharedCommissionAmount": 0,
              "sharedCommissionAmountInWorkerCurrency": 0,
              "dataForIterable": {
                "project_id": 110622,
                "create_type": "API_2",
                "company_id": 100001385,
                "worker_id": 100254730,
                "price": 64.81,
                "commission_percent": 3.5,
                "commission_amount": 2.27,
                "currency": "USD",
                "created_at": "2026-05-20 20:24:36",
                "deadline": {
                  "type": 1,
                  "triggerDate": "2026-05-23 22:24:30",
                  "isComingUp": true
                },
                "status": 2
              }
            }
          ],
          "pagination": {
            "count": 1,
            "total": 146,
            "perPage": 1,
            "page": 1,
            "pages": 146
          }
        }
        JSON);

        $response->method('getBody')->willReturn($stream);

        $actual = $this->converter->convert($response, TaskCollectionResponse::class);

        $expected = new TaskCollectionResponse(
            items: [
                new TaskResponse(
                    attributes: [
                        [
                            'id' => 7840,
                            'title' => 'Количество',
                            'titleEn' => 'Quantity',
                            'description' => 'Работа в количественном выражении (любая единица измерения)',
                            'descriptionEn' => 'Use any unit of measurement',
                            'type' => 'text',
                            'attrTypeId' => 9,
                            'values' => [['title' => '1']],
                        ],
                        [
                            'id' => 7841,
                            'title' => 'Дата/Период',
                            'titleEn' => 'Date/Period',
                            'description' => 'Дата или период оказания услуги',
                            'descriptionEn' => 'Date or period of rendering the service',
                            'type' => 'text',
                            'attrTypeId' => 49,
                            'values' => [['title' => '07/05/2026 a 08/05/2026']],
                        ],
                        [
                            'id' => 7843,
                            'title' => 'Регион/Адрес',
                            'titleEn' => 'Region/Address',
                            'description' => 'Место оказания услуги',
                            'descriptionEn' => 'Location of the service',
                            'type' => 'text',
                            'attrTypeId' => 35,
                            'values' => [['title' => 'CO']],
                        ],
                    ],
                    messages: [],
                    creator: [
                        'id' => 100254728,
                        'uuid' => 'b1dd00c3-3cfb-42b5-afe6-23d541ae524f',
                        'fullName' => ' ',
                        'language' => 'EN',
                    ],
                    id: 110622,
                    uuid: '0e91a99a-69cc-46b2-8394-beca9510277a',
                    token: 'MGU5MWE5OWEtNjljYy00NmIyLTgzOTQtYmVjYTk1MTAyNzdh',
                    title: 'Proyecto 882 Web developer services',
                    description: 'Proyecto 882 Web developer services. Tasa de cambio COP/USD 3795.98.',
                    price: 64.81,
                    priceInWorkerCurrency: 64.81,
                    priceWithCommission: 67.08,
                    commissionAmount: 2.27,
                    commissionAmountInWorkerCurrency: 2.27,
                    commissionPercent: 3.5,
                    companyId: 100001385,
                    actions: [],
                    additionalAttributes: null,
                    service: [
                        'id' => 3162,
                        'title' => 'Услуги веб-разработчика',
                        'titleEn' => 'Web developer services',
                        'titleDoc' => 'Услуги веб-разработчика',
                        'titleDocEn' => 'Web developer services',
                    ],
                    category: [
                        'id' => 310,
                        'title' => 'Список услуг',
                        'titleEn' => 'List of services',
                        'type' => 2,
                    ],
                    deadline: [
                        'type' => 1,
                        'triggerDate' => '2026-05-23 22:24:30',
                        'isComingUp' => true,
                    ],
                    hold: [
                        'type' => 'on_task_create',
                        'isActive' => true,
                    ],
                    insurance: [
                        'status' => 1,
                        'cost' => 0,
                    ],
                    activeDispute: null,
                    activeChangesetId: null,
                    vat: 0,
                    fullPriceWithVAT: 67.08,
                    insuranceCost: 0,
                    issueCode: null,
                    offerTaskId: null,
                    hasPayout: false,
                    serviceFeeCompensation: 0,
                    serviceFeeCompensationPercent: 0,
                    reportId: null,
                    shareCommission: false,
                    sharedCommissionAmount: 0,
                    sharedCommissionAmountInWorkerCurrency: 0,
                    dataForIterable: [
                        'project_id' => 110622,
                        'create_type' => 'API_2',
                        'company_id' => 100001385,
                        'worker_id' => 100254730,
                        'price' => 64.81,
                        'commission_percent' => 3.5,
                        'commission_amount' => 2.27,
                        'currency' => 'USD',
                        'created_at' => '2026-05-20 20:24:36',
                        'deadline' => [
                            'type' => 1,
                            'triggerDate' => '2026-05-23 22:24:30',
                            'isComingUp' => true,
                        ],
                        'status' => 2,
                    ],
                    worker: [
                        'name' => 'John Mock-Doe',
                        'id' => 100254730,
                        'email' => 'guillermo.lengemann@gmail.com',
                        'firstName' => 'John',
                        'lastName' => 'Mock-Doe',
                        'isVerified' => true,
                        'category' => [
                            'title' => 'Веб-разработчик',
                            'titleEn' => 'Web developer',
                        ],
                        'taxationStatus' => 1,
                        'about' => '',
                        'uuid' => '651dc34d-291a-4ba6-a92a-70003b705f1d',
                        'country' => [
                            'name' => 'Колумбия',
                            'nameEn' => 'Colombia',
                            'iso' => 'CO',
                        ],
                    ],
                    payer: [
                        'id' => 0,
                        'fullName' => ' ',
                    ],
                    files: [],
                    links: [],
                    agreementFileLink: null,
                    messageCount: 0,
                    group: null,
                    copyright: false,
                    createType: 'API_2',
                    currency: [
                        'currency' => 'USD',
                        'id' => 2,
                    ],
                    workerCurrency: [
                        'currency' => 'USD',
                        'id' => 2,
                    ],
                    customer: [
                        'id' => 100001385,
                        'title' => 'Impacter3.0 S.L.',
                    ],
                    dateCreated: '2026-05-20 20:24:36',
                    dateAccepted: null,
                    dateEnd: '2026-05-23 22:24:30',
                    dateFinished: null,
                    datePaid: null,
                    datePayAt: null,
                    documentDate: null,
                    needReport: false,
                    state: 2,
                    merchantId: null,
                ),
            ],
            pagination: new TaskPaginationResponse(
                count: 1,
                total: 146,
                perPage: 1,
                page: 1,
                pages: 146,
            ),
        );

        $this->assertEquals($expected, $actual);
    }

    // //1 array:1 [
    ////  "workerId" => "Worker with id 1166115 not found"
    ////]
    //
    ////2 422
}
