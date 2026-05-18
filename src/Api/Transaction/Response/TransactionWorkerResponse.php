<?php

declare(strict_types=1);

namespace Mellow\Api\Transaction\Response;

class TransactionWorkerResponse
{
    public function __construct(
        public int $id,
        public string $firstName,
        public string $lastName,
    ) {
    }
}
