<?php

declare(strict_types=1);

namespace Mellow\Api\Freelancer\Response;

class FreelancerCollectionResponse
{
    /**
     * @param FreelancerListResponse[] $items
     */
    public function __construct(
        public readonly array $items,
        public readonly FreelancerListPaginationResponse $pagination,
    ) {
    }
}
