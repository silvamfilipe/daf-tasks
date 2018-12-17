<?php

namespace spec\App;

use App\CreateTaskCommand;
use App\CreateTaskHandler;
use App\Domain\Task;
use App\Domain\TasksRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CreateTaskHandlerSpec extends ObjectBehavior
{
    function let(TasksRepository $tasks)
    {
        $tasks->add(Argument::type(Task::class))
            ->willReturnArgument(0);

        $this->beConstructedWith($tasks);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CreateTaskHandler::class);
    }

    function it_handles_create_task_command(TasksRepository $tasks)
    {
        $description = 'Finish my class';
        $command = new CreateTaskCommand($description);

        $task = $this->handle($command);

        $task->shouldBeAnInstanceOf(Task::class);
        $task->description()->shouldBe($description);
        $tasks->add($task)->shouldHaveBeenCalled();
    }
}
