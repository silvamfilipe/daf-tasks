<?php

namespace App\Domain\Task;

use App\Domain\Comparable;
use App\Domain\Stringable;
use Ramsey\Uuid\Uuid;

class TaskId implements Stringable, Comparable
{
    private $uuid;

    /**
     * TaskId constructor.
     * @param string|null $uuidStr
     * @throws \Exception
     */
    public function __construct(string $uuidStr = null)
    {
        $this->uuid = $uuidStr
            ? Uuid::fromString($uuidStr)
            : Uuid::uuid4();
    }

    /**
     * Sends out a text version of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->uuid;
    }

    /**
     * Compares two object
     *
     * @param mixed $other
     * @return bool
     */
    public function equalsTo($other): bool
    {
        if (! $other instanceof TaskId) {
            return false;
        }

        return $other->uuid->equals($this->uuid);
    }
}
