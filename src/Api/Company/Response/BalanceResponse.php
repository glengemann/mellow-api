<?php

declare(strict_types=1);

namespace Mellow\Api\Company\Response;

final readonly class BalanceResponse
{
    public function __construct(
        /** @var array{currency: string, id: int} */
        public array $currency,
        public int $id,
        public bool $showVat,
        public float|int $balanceAmount,
        public float|int $balanceAmountVat,
        public float|int $holdAmount,
        public float|int $holdAmountVat,
        public float|int $toPayAmount,
        public float|int $toPayAmountVat,
    ) {
    }
}
