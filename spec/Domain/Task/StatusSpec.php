<?php

namespace spec\App\Domain\Task;

use App\Domain\Comparable;
use App\Domain\Stringable;
use App\Domain\Task\Status;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StatusSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(Status::DONE);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Status::class);
    }

    function its_a_known_status()
    {
        $this->beConstructedWith('old');
        $this->shouldThrow(\InvalidArgumentException::class)
            ->duringInstantiation();
    }

    function it_can_be_created_statically()
    {
        $status = Status::postpone();
        if (! $status instanceof Status) {
            throw new FailureException(
                "Expected to have a status, but got none..."
            );
        }
    }

    function it_can_be_converted_to_string()
    {
        $this->shouldBeAnInstanceOf(Stringable::class);
        $this->__toString()->shouldBe(Status::DONE);
    }

    function it_can_be_compared_to_other_status()
    {
        $done = Status::done();
        $this->shouldBeAnInstanceOf(Comparable::class);
        $this->equalsTo($done)->shouldBe(true);
        $this->equalsTo(Status::created())->shouldBe(false);
        $this->equalsTo('cebolas')->shouldNotBe(true);
    }

}
