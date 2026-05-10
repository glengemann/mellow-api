<?php

declare(strict_types=1);

namespace Mellow\Api\Freelancer;

use Mellow\Api\AbstractApi;
use Mellow\Api\Freelancer\Parameter\FreelancerListParameters;
use Mellow\Api\Freelancer\Parameter\InviteParameters;
use Mellow\Api\Freelancer\Parameter\RemoveParameters;
use Mellow\Api\Freelancer\Response\FreelancerCollectionResponse;
use Mellow\Api\Freelancer\Response\FreelancerListPaginationResponse;
use Mellow\Api\Freelancer\Response\FreelancerListResponse;
use Mellow\Api\Freelancer\Response\InviteResponse;
use Mellow\Api\Freelancer\Response\RemoveResponse;

class Freelancer extends AbstractApi
{
    /**
     * @see https://my.mellow.io/api/docs/#inviting-freelancer
     *
     * @return InviteResponse
     */
    public function invite(InviteParameters $parameters): object|array
    {
        $url = sprintf('customer/freelancers');

        $response = $this->post($url, $parameters->toArray());

        return $this->responseConverter->convert($response, InviteResponse::class);
    }

    /**
     * @see https://my.mellow.io/api/docs/#retrieving-freelancer-list
     */
    public function list(FreelancerListParameters $parameters)
    {
        $url = sprintf('customer/freelancers');

        if (0 !== count($parameters->toArray())) {
            $url .= '?' . http_build_query($parameters->toArray());
        }

        $response = $this->get($url);
        $response = $response->getBody()->getContents();
        $response = json_decode($response, true);

        $items = array_map(
            fn ($item) => new FreelancerListResponse(...$item),
            $response['items'] ?? []
        );

        $pagination = new FreelancerListPaginationResponse(...$response['pagination']);

        return new FreelancerCollectionResponse($items, $pagination);
    }

    /**
     * @see https://my.mellow.io/api/docs/#removing-freelancers-from-team
     */
    public function remove(RemoveParameters $parameters)
    {
        $url = sprintf('customer/freelancers');

        $response = $this->delete($url, $parameters->toArray());

        return $this->responseConverter->convert($response, RemoveResponse::class);
    }
}
