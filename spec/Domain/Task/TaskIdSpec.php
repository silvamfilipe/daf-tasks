<?php

namespace spec\App\Domain\Task;

use App\Domain\Comparable;
use App\Domain\Stringable;
use App\Domain\Task\TaskId;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;

class TaskIdSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TaskId::class);
    }

    /**
     * @throws FailureException
     */
    function it_can_be_converted_to_string()
    {
        $this->shouldBeAnInstanceOf(Stringable::class);
        $uuidText = $this->__toString()->getWrappedObject();
        try {
            Uuid::fromString($uuidText);
        } catch (InvalidUuidStringException $caught) {
            throw new FailureException($caught->getMessage());
        }
    }

    function it_can_be_comparable()
    {
        $this->shouldBeAnInstanceOf(Comparable::class);
        $other = new TaskId();
        $this->equalsTo($other)->shouldBe(false);
        $this->equalsTo($this->getWrappedObject())->shouldBe(true);
    }

    function it_can_be_created_from_a_given_string()
    {
        $uuidStr = Uuid::uuid4()->toString();
        $this->beConstructedWith($uuidStr);

        $this->equalsTo(new TaskId(Uuid::fromString($uuidStr)))->shouldBe(true);
    }
}
