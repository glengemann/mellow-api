<?php

declare(strict_types=1);

namespace Mellow\Api\Transaction\Response;

use Mellow\Api\Currency;

class TransactionCurrencyResponse
{
    public function __construct(
        public string $currency,
        public int $id,
    ) {
    }
}
