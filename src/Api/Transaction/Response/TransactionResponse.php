<?php

declare(strict_types=1);

namespace Mellow\Api\Transaction\Response;

class TransactionResponse
{
    public function __construct(
        public int $id,
        public int $taskId,
        public int $type,
        public float $amount,
        public \DateTimeImmutable $createdAt,
        public TransactionCurrencyResponse $currency,
        public ?float $taxRate,
        public int $balanceId,
        public TransactionWorkerResponse $worker,
        public ?int $invoiceId,
    ) {
    }
}
