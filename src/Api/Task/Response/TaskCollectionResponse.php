<?php

declare(strict_types=1);

namespace Mellow\Api\Task\Response;

final readonly class TaskCollectionResponse
{
    /** @param TaskResponse[] $items */
    public function __construct(
        public array $items,
        public TaskPaginationResponse $pagination,
    ) {
    }
}
