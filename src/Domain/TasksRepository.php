<?php
/**
 * Created by PhpStorm.
 * User: fsilva
 * Date: 22-11-2018
 * Time: 9:44
 */

namespace App\Domain;


use App\Domain\Task\Status;
use App\Domain\Task\TaskId;

interface TasksRepository
{

    public function add(Task $task): Task;

    public function tasks(Status $status = null): array;

    public function withTaskId(TaskId $taskId): Task;

    public function update(Task $task): Task;

}