<?php

declare(strict_types=1);

namespace Mellow\Api\Freelancer\Parameter;

class FreelancerListParameters
{
    /**
     * @param array{
     *     page?: int,
     *     size?: int,
     *     filter?: FreelancerFilter,
     * } $parameters
     */
    public function __construct(
        private array $parameters = [],
    ) {
    }

    /**
     * @return array{
     *     page?: int,
     *     size?: int,
     *     filter?: array{
     *         isVerified?: bool,
     *         isInviteEmailSent?: bool,
     *         dateInvitedFrom?: string,
     *         dateInvitedTo?: string,
     *     },
     * }
     */
    public function toArray(): array
    {
        $parameters = [];

        if (true === isset($this->parameters['page'])) {
            $parameters['page'] = $this->parameters['page'];
        }

        if (true === isset($this->parameters['size'])) {
            $parameters['size'] = $this->parameters['size'];
        }

        if (true === isset($this->parameters['filter'])) {
            $parameters['filter'] = $this->parameters['filter']->toArray();
        }

        return $parameters;
    }

    public function page(int $page = 1): self
    {
        $this->parameters['page'] = $page;

        return $this;
    }

    public function size(int $size = 20): self
    {
        $this->parameters['size'] = $size;

        return $this;
    }

    public function filter(FreelancerFilter $filter): self
    {
        $this->parameters['filter'] = $filter;

        return $this;
    }
}
