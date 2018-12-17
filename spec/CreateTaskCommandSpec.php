<?php

namespace spec\App;

use App\CreateTaskCommand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CreateTaskCommandSpec extends ObjectBehavior
{

    private $description;

    function let()
    {
        $this->description = 'Teach something...';
        $this->beConstructedWith($this->description);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CreateTaskCommand::class);
    }

    function it_has_a_description()
    {
        $this->description()->shouldBe($this->description);
    }
}
