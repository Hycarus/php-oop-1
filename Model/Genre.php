<?php

class Genre
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}

$action = new Genre('Action');
$comedy = new Genre('Comedy');
