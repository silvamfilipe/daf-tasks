<?php

namespace App\Application;

use App\Domain\Task\TaskId;

class FinishTaskCommand
{
    /**
     * @var TaskId
     */
    private $taskId;

    /**
     * FinishTaskCommand constructor.
     * @param TaskId $taskId
     */
    public function __construct(TaskId $taskId)
    {
        $this->taskId = $taskId;
    }

    public function taskId(): TaskId
    {
        return $this->taskId;
    }
}
