<?php

namespace App\Application;

use App\Domain\Task;
use App\Domain\TasksRepository;

class FinishTaskHandler
{
    /**
     * @var TasksRepository
     */
    private $tasks;

    /**
     * FinishTaskHandler constructor.
     * @param TasksRepository $tasks
     */
    public function __construct(TasksRepository $tasks)
    {
        $this->tasks = $tasks;
    }


    public function handle(FinishTaskCommand $command): Task
    {
        $task = $this->tasks->withTaskId($command->taskId());
        $task->finish();
        return $this->tasks->update($task);
    }
}
