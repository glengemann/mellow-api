<?php

declare(strict_types=1);

namespace Mellow\Api\Task\Parameter;

class PublishDraftParameters
{
    public function __construct(
        private array $parameters = [],
    ) {
    }

    /**
     * @return array{
     *     taskId?: int,
     *     uuid?: string,
     *     companyId: int,
     * }
     */
    public function toArray(): array
    {
        return $this->parameters;
    }

    public function taskId(int $taskId): self
    {
        $this->parameters['taskId'] = $taskId;

        return $this;
    }

    public function uuid(string $uuid): self
    {
        $this->parameters['uuid'] = $uuid;

        return $this;
    }

    public function companyId(int $companyId): self
    {
        $this->parameters['companyId'] = $companyId;

        return $this;
    }
}
