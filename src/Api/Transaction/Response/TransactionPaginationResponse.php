<?php

declare(strict_types=1);

namespace Mellow\Api\Transaction\Response;

class TransactionPaginationResponse
{
    public function __construct(
        public int $count,
        public int $total,
        public int $perPage,
        public int $page,
        public int $pages,
    ) {
    }
}
