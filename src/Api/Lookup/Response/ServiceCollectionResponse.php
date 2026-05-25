<?php

declare(strict_types=1);

namespace Mellow\Api\Lookup\Response;

class ServiceCollectionResponse
{
    /** @param ServiceResponse[] $items */
    public function __construct(
        public array $items,
        public ServicePaginationResponse $pagination,
    ) {
    }
}
