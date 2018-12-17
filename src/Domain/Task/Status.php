<?php

namespace App\Domain\Task;

use App\Domain\Comparable;
use App\Domain\Stringable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Status
 * @package App\Domain\Task
 *
 * @method static Status created()
 * @method static Status done()
 * @method static Status postpone()
 *
 * @ORM\Embeddable
 */
class Status implements Stringable, Comparable
{

    const CREATED  = 'created';
    const DONE     = 'done';
    const POSTPONE = 'postpone';

    private static $values = [
        self::CREATED, self::DONE, self::POSTPONE
    ];

    /**
     * @var string
     * @ORM\Column
     */
    private $value;

    public function __construct(string $value)
    {
        if (!in_array($value, self::$values)) {
            throw new \InvalidArgumentException(
                "Unknown status value '{$value}'"
            );
        }

        $this->value = $value;
    }

    public static function __callStatic($name, $params)
    {
        return new Status($name);
    }

    /**
     * Sends out a text version of this object
     *
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * Compares two object
     *
     * @param mixed $other
     * @return bool
     */
    public function equalsTo($other): bool
    {
        if (!is_a($other, Status::class)) {
            return false;
        }

        return $other->value === $this->value;
    }
}
