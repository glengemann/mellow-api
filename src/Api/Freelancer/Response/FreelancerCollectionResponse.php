<?php

declare(strict_types=1);

namespace Mellow\Api\Freelancer\Response;

final class FreelancerCollectionResponse
{
    /**
     * @param FreelancerResponse[] $items
     */
    public function __construct(
        public readonly array $items,
        public readonly FreelancerPaginationResponse $pagination,
    ) {
    }
}
