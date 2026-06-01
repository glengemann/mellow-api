<?php

declare(strict_types=1);

namespace Mellow\Api\Task\Parameter;

class ResumeTaskParameters
{
    public function __construct(
        private array $parameters = [],
    ) {
    }

    /**
     * @return array{
     *     taskId: int,
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
}
