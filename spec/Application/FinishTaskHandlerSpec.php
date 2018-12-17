<?php

namespace spec\App\Application;

use App\Application\FinishTaskCommand;
use App\Application\FinishTaskHandler;
use App\Domain\Task;
use App\Domain\Task\TaskId;
use App\Domain\TasksRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FinishTaskHandlerSpec extends ObjectBehavior
{
    private $taskId;

    /**
     * @param TasksRepository|\PhpSpec\Wrapper\Collaborator $tasks
     * @param Task|\PhpSpec\Wrapper\Collaborator $task
     * @throws \Exception
     */
    function let(
        TasksRepository $tasks,
        Task $task
    ) {

        $this->taskId = new TaskId();

        $tasks->withTaskId($this->taskId)->willReturn($task);
        $tasks->update($task)->willReturnArgument(0);

        $this->beConstructedWith($tasks);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FinishTaskHandler::class);
    }

    function it_handles_finish_task_command(Task $task, TasksRepository $tasks)
    {
        $command = new FinishTaskCommand($this->taskId);

        $task->finish()->shouldBeCalled();

        $this->handle($command)->shouldBe($task);
        $tasks->update($task)->shouldHaveBeenCalled();
    }
}
