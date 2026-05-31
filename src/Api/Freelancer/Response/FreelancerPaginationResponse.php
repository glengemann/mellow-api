<?php

declare(strict_types=1);

namespace Mellow\Api\Freelancer\Response;

final class FreelancerPaginationResponse
{
    public function __construct(
        public readonly int $count,
        public readonly int $total,
        public readonly int $perPage,
        public readonly int $page,
        public readonly int $pages,
    ) {
    }
}
