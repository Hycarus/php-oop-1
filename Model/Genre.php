<?php

class Genre
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}
$genresString = file_get_contents(__DIR__ . "/../Model/genre_db.json");
$genresArray = json_decode($genresString, true);
$genres = [];
foreach ($genresArray as $item) {
    $genres[] = new Genre($item);
}
// $action = new Genre('Action');
// $comedy = new Genre('Comedy');
