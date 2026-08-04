<?php

declare(strict_types=1);

namespace Mellow\Api\Company\Parameter;

class OperatingAddressParameters
{
    public function __construct(
        private array $parameters = [],
    ) {
    }

    /**
     * @return array{
     *     address: string,
     *     city: string,
     *     state: string,
     *     zipCode: string,
     *     country: string
     * }
     */
    public function toArray(): array
    {
        return $this->parameters;
    }

    public function address(string $address): self
    {
        $this->parameters['address'] = $address;

        return $this;
    }

    public function city(string $city): self
    {
        $this->parameters['city'] = $city;

        return $this;
    }

    public function state(string $state): self
    {
        $this->parameters['state'] = $state;

        return $this;
    }

    public function zipCode(string $zipCode): self
    {
        $this->parameters['zipCode'] = $zipCode;

        return $this;
    }

    public function country(string $country): self
    {
        $this->parameters['country'] = $country;

        return $this;
    }
}
