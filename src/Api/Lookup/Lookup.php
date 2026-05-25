<?php

declare(strict_types=1);

namespace Mellow\Api\Lookup;

use Mellow\Api\AbstractApi;
use Mellow\Api\Lookup\Parameter\ServiceAttributesParameters;
use Mellow\Api\Lookup\Response\ServiceAttributeResponse;
use Mellow\Api\Lookup\Response\ServiceCollectionResponse;

class Lookup extends AbstractApi
{
    /** @return ServiceCollectionResponse */
    public function services(ServiceAttributesParameters $parameters)
    {
        $url = 'customer/lookups/services';

        if (0 !== count($parameters->toArray())) {
            $url .= '?' . http_build_query($parameters->toArray());
        }

        $response = $this->get($url);

        return $this->responseConverter->convert($response, ServiceCollectionResponse::class);
    }

    public function serviceAttributes(): array
    {
        $url = 'customer/lookups/service-attributes';

        $response = $this->get($url);

        return $this->responseConverter->convert($response, ServiceAttributeResponse::class . '[]');
    }
}
