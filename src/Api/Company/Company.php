<?php

declare(strict_types=1);

namespace Mellow\Api\Company;

use Mellow\Api\AbstractApi;
use Mellow\Api\Company\Response\BalanceResponse;
use Mellow\Api\Company\Response\CompanyCollectionResponse;

class Company extends AbstractApi
{
    public function list()
    {
        $url = 'customer/companies';

        $response = $this->get($url);

        return $this->responseConverter->convert($response, CompanyCollectionResponse::class);
    }

    public function default(int $companyId)
    {
        $url = sprintf('customer/companies/%d/default', $companyId);

        $response = $this->post($url);

        return $this->responseConverter->convert($response, \stdClass::class);
    }

    public function balance()
    {
        $url = 'customer/balance';

        $response = $this->get($url);

        return $this->responseConverter->convert($response, BalanceResponse::class);
    }
}
