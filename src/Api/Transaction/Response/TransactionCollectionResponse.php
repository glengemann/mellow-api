<?php

declare(strict_types=1);

namespace Mellow\Api\Transaction\Response;

final readonly class TransactionCollectionResponse
{
    /** @param TransactionResponse[] $items */
    public function __construct(
        public array $items,
        public TransactionPaginationResponse $pagination,
    ) {
    }
}
