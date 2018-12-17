<?php

namespace spec\App\Application;

use App\Application\FinishTaskCommand;
use App\Domain\Task\TaskId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FinishTaskCommandSpec extends ObjectBehavior
{

    private $taskId;

    /**
     * @throws \Exception
     */
    function let()
    {
        $this->taskId = new TaskId();
        $this->beConstructedWith($this->taskId);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FinishTaskCommand::class);
    }

    function it_has_a_task_id()
    {
        $this->taskId()->shouldBe($this->taskId);
    }
}
