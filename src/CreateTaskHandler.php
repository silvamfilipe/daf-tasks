<?php

namespace App;

use App\Domain\Task;
use App\Domain\TasksRepository;

class CreateTaskHandler
{
    /**
     * @var TasksRepository
     */
    private $tasks;

    public function __construct(TasksRepository $tasks)
    {
        $this->tasks = $tasks;
    }

    public function handle(CreateTaskCommand $command)
    {
        $task = new Task($command->description());
        return $this->tasks->add($task);
    }
}
