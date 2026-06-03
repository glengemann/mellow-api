<?php

declare(strict_types=1);

namespace Mellow\Api\Task;

use Mellow\Api\AbstractApi;
use Mellow\Api\Task\Parameter\AcceptTaskParameters;
use Mellow\Api\Task\Parameter\CreateParameters;
use Mellow\Api\Task\Parameter\DeclineTaskParameters;
use Mellow\Api\Task\Parameter\FilterParameters;
use Mellow\Api\Task\Parameter\PayTaskParameters;
use Mellow\Api\Task\Parameter\PublishDraftParameters;
use Mellow\Api\Task\Parameter\ResumeTaskParameters;
use Mellow\Api\Task\Response\AcceptTaskResponse;
use Mellow\Api\Task\Response\CreateTaskResponse;
use Mellow\Api\Task\Response\DeclineTaskResponse;
use Mellow\Api\Task\Response\PayTaskResponse;
use Mellow\Api\Task\Response\ResumeTaskResponse;
use Mellow\Api\Task\Response\TaskCollectionResponse;
use Mellow\Api\Task\Response\TaskResponse;

class Task extends AbstractApi
{
    /**
     * @see https://my.mellow.io/api/docs/#retrieving-task-list
     */
    public function list(FilterParameters $parameters)
    {
        $url = sprintf('customer/tasks');

        if (0 !== count($parameters->toArray())) {
            $url .= '?' . http_build_query($parameters->toArray());
        }

        $response = $this->get($url);

        return $this->responseConverter->convert($response, TaskCollectionResponse::class);
    }

    /**
     * @see https://my.mellow.io/api/docs/#creating-a-task
     */
    public function create(CreateParameters $parameters)
    {
        $url = 'customer/tasks';

        $response = $this->post($url, $parameters->toArray());

        return $this->responseConverter->convert($response, CreateTaskResponse::class);
    }

    /**
     * @see https://my.mellow.io/api/docs/#retrieving-tasks-using-their-ids
     */
    public function retrieve(string|int $taskId): object|array
    {
        $url = sprintf('customer/tasks/%s', $taskId);

        $response = $this->get($url);

        return $this->responseConverter->convert($response, TaskResponse::class);
    }

    /**
     * @see https://my.mellow.io/api/docs/#accepting-task
     */
    public function accept(AcceptTaskParameters $parameters)
    {
        $url = 'customer/tasks/accept';

        $response = $this->post($url, $parameters->toArray());

        return $this->responseConverter->convert($response, AcceptTaskResponse::class);
    }

    /**
     * @see https://my.mellow.io/api/docs/#declining-rejecting-task
     */
    public function decline(DeclineTaskParameters $parameters)
    {
        $url = 'customer/tasks/decline';

        $response = $this->post($url, $parameters->toArray());

        return $this->responseConverter->convert($response, DeclineTaskResponse::class);
    }

    /**
     * @see https://my.mellow.io/api/docs/#pay-for-task
     */
    public function pay(PayTaskParameters $parameters)
    {
        $url = 'customer/tasks/pay';

        $response = $this->post($url, $parameters->toArray());

        return $this->responseConverter->convert($response, PayTaskResponse::class);
    }

    /**
     * @see https://my.mellow.io/api/docs/#resume-task
     */
    public function resume(ResumeTaskParameters $parameters)
    {
        $url = 'customer/tasks/return-to-work';

        $response = $this->post($url, $parameters->toArray());

        return $this->responseConverter->convert($response, ResumeTaskResponse::class);
    }

    /**
     * @see https://my.mellow.io/api/docs/#publishing-a-draft-task
     */
    public function publish(PublishDraftParameters $parameters)
    {
        $url = 'customer/tasks/publish-draft';

        $response = $this->post($url, $parameters->toArray());

        return $this->responseConverter->convert($response, CreateTaskResponse::class);
    }
}
