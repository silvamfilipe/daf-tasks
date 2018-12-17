<?php

namespace App\Domain;


interface Stringable
{

    /**
     * Sends out a text version of this object
     *
     * @return string
     */
    public function __toString();
}