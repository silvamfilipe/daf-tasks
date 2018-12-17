<?php

namespace spec\App\Domain;

use App\Domain\Task;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TaskSpec extends ObjectBehavior
{
    private $description;

    function let()
    {
        $this->description = 'Teach how to do tests!';
        $this->beConstructedWith($this->description);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Task::class);
    }

    function it_has_a_description()
    {
        $this->description()->shouldBe($this->description);
    }

    function it_has_a_task_id()
    {
        $this->taskId()->shouldBeAnInstanceOf(Task\TaskId::class);
    }

    function it_has_a_created_status()
    {
        $this->status()->shouldBeAnInstanceOf(Task\Status::class);
    }

    /**
     * @throws \Exception
     */
    function it_can_have_a_due_date()
    {
        $dateTimeImmutable = new \DateTimeImmutable();

        $this->dueDate()->shouldBeNull();
        $this->finishBefore($dateTimeImmutable);

        $this->dueDate()->shouldBe($dateTimeImmutable);
    }

    function it_can_be_finished()
    {
        $this->finish();
        $this->status()
            ->equalsTo(Task\Status::done())
            ->shouldBe(true);
    }

    function it_has_a_finished_state()
    {
        $this->isDone()->shouldBe(false);
        $this->finish();
        $this->isDone()->shouldBe(true);
    }
}
