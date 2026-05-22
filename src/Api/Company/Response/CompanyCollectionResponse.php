<?php

declare(strict_types=1);

namespace Mellow\Api\Company\Response;

final class CompanyCollectionResponse
{
    /** @param CompanyResponse[] $items */
    public function __construct(
        public array $items,
        public CompanyPaginationResponse $pagination,
    ) {
    }
}
