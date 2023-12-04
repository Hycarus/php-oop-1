<?php
include __DIR__ . '/Genre.php';
class Movie
{
    private int $id;
    private string $title;
    private string $overview;
    private float $vote_average;
    private string $poster_path;
    private string $original_language;
    public Genre $genre;

    function __construct($id, $title, $overview, $vote, $image, $language, Genre $genre)
    {
        $this->id = $id;
        $this->title = $title;
        $this->overview = $overview;
        $this->vote_average = $vote;
        $this->poster_path = $image;
        $this->original_language = $language;
        $this->genre = $genre;
    }

    public function getVote()
    {
        $vote = ceil($this->vote_average / 2);
        $template = "<p>";
        for ($n = 1; $n <= 5; $n++) {
            $template .= $n <= $vote ? '<i class="fa-solid fa-star"></i>' : '<i class="fa-regular fa-star"></i>';
        }
        $template .= '</p>';
        return $template;
    }

    public function printCard()
    {
        $image = $this->poster_path;
        $title = $this->title;
        $content = $this->overview;
        $custom = $this->getVote();
        $genre = $this->genre->name;
        include __DIR__ . '/../Views/card.php';
    }
}

$movieString = file_get_contents(__DIR__ . '/movie_db.json');
$movieList = json_decode($movieString, true);

$movies = [];

$action = new Genre('Action');
$comedy = new Genre('Comedy');

foreach ($movieList as $item) {
    // $randgenre = $genres[rand(0, count($genres) - 1)];
    $movies[] = new Movie($item['id'], $item['title'], $item['overview'], $item['vote_average'], $item['poster_path'], $item['original_language'], $action);
}
// var_dump($movies);
// var_dump($movies[0]->title);