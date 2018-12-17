<?php

namespace App\Domain;

use App\Domain\Task\Status;
use App\Domain\Task\TaskId;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Task
 * @package App\Domain
 *
 * @ORM\Entity
 * @ORM\Table(name="tasks")
 */
class Task
{
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @var TaskId
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="TaskId", name="id")
     */
    private $taskId;

    /**
     * @var Status
     * @ORM\Embedded(class="App\Domain\Task\Status")
     */
    private $status;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $dueDate = null;

    /**
     * Task constructor.
     * @param string $description
     * @throws \Exception
     */
    public function __construct(string $description)
    {
        $this->description = $description;
        $this->taskId = new TaskId();
        $this->status = Status::created();
    }

    public function description(): string
    {
        return $this->description;
    }

    public function taskId(): TaskId
    {
        return $this->taskId;
    }

    public function status(): Status
    {
        return $this->status;
    }

    public function dueDate(): ?\DateTimeImmutable
    {
        return $this->dueDate;
    }

    public function finishBefore(\DateTimeImmutable $dueDate)
    {
        $this->dueDate = $dueDate;
    }

    public function finish()
    {
        $this->status = Status::done();
    }

    public function isDone(): bool
    {
        return $this->status->equalsTo(Status::done());
    }
}
