<?php
/**
 * Created by PhpStorm.
 * User: fsilva
 * Date: 21-11-2018
 * Time: 18:06
 */

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Task\TaskId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

/**
 * Class DoctrineTaskId
 * @package App\Infrastructure\Persistence\Doctrine
 */
class DoctrineTaskId extends StringType
{

    /**
     * @inheritdoc
     * @param TaskId $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return (string) $value;
    }

    /**
     * Converts a value from its database representation to its PHP representation
     * of this type.
     *
     * @param mixed                                     $value    The value to convert.
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform The currently used database platform.
     *
     * @return mixed The PHP representation of the value.
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new TaskId($value);
    }

}