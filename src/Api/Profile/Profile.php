<?php

declare(strict_types=1);

namespace Mellow\Api\Profile;

use Mellow\Api\AbstractApi;
use Mellow\Api\Profile\Response\ProfileResponse;

class Profile extends AbstractApi
{
    public function profile()
    {
        $url = 'profile';

        $response = $this->get($url);

        return $this->responseConverter->convert($response, ProfileResponse::class);
    }
}
