<?php

declare(strict_types=1);

namespace Mellow\Api\Company;

use Mellow\Api\AbstractApi;
use Mellow\Api\Company\Parameter\OperatingAddressParameters;
use Mellow\Api\Company\Response\BalanceResponse;
use Mellow\Api\Company\Response\CompanyCollectionResponse;
use Mellow\Api\Company\Response\DefaultResponse;
use Mellow\Api\Company\Response\OperatingAddressResponse;

class Company extends AbstractApi
{
    /**
     * @see https://my.mellow.io/api/docs/#company--retrieving-user's-companies
     */
    public function list(): CompanyCollectionResponse
    {
        $url = 'customer/companies';

        $response = $this->get($url);

        return $this->responseConverter->convert($response, CompanyCollectionResponse::class);
    }

    /**
     * @see https://my.mellow.io/api/docs/#company--changing-company
     */
    public function default(int $companyId): DefaultResponse
    {
        $url = sprintf('customer/companies/%d/default', $companyId);

        $response = $this->post($url);

        return $this->responseConverter->convert($response, DefaultResponse::class);
    }

    /**
     * @see https://my.mellow.io/api/docs/#company--retrieving-company-balance
     */
    public function balance(): BalanceResponse
    {
        $url = 'customer/balance';

        $response = $this->get($url);

        return $this->responseConverter->convert($response, BalanceResponse::class);
    }

    /**
     * @see https://my.mellow.io/api/docs/#company--setting-company-operating-address
     */
    public function setOperatingAddress(OperatingAddressParameters $parameters): OperatingAddressResponse
    {
        $url = 'customer/companies/operating-address';

        $response = $this->post($url, $parameters->toArray());

        return $this->responseConverter->convert($response, OperatingAddressResponse::class);
    }
}
