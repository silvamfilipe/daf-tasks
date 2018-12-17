<?php

namespace App\Domain;


interface Comparable
{

    /**
     * Compares two object
     *
     * @param mixed $other
     * @return bool
     */
    public function equalsTo($other): bool;
}
