<?php

declare(strict_types=1);

namespace Mellow\Api\Transaction;

use Mellow\Api\AbstractApi;
use Mellow\Api\Transaction\Response\TransactionCollectionResponse;

class Transaction extends AbstractApi
{
    public function list()
    {
        $url = '/customer/transactions';

        $response = $this->get($url);

        return $this->responseConverter->convert($response, TransactionCollectionResponse::class);
    }
}
