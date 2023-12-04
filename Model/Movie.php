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
    public array $genre;

    function __construct($id, $title, $overview, $vote, $image, $language, $genre)
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

    public function getFlag()
    {
        $flag = 'img/' . $this->original_language . '.gif';
        return $flag;
    }

    public function printCard()
    {
        $image = $this->poster_path;
        $title = $this->title;
        $content = $this->overview;
        $custom = $this->getVote();
        $genre = $this->genre;
        $flag = $this->getFlag();
        include __DIR__ . '/../Views/card.php';
    }
}

$movieString = file_get_contents(__DIR__ . '/movie_db.json');
$movieList = json_decode($movieString, true);

$movies = [];


foreach ($movieList as $item) {
    $randomGenres = [];
    for ($i = 0; $i < count($item['genre_ids']); $i++) {
        $index = rand(0, count($genres) - 1);
        $randGenre = $genres[$index];
        array_push($randomGenres, $randGenre);
    }

    $movies[] = new Movie($item['id'], $item['title'], $item['overview'], $item['vote_average'], $item['poster_path'], $item['original_language'], $randomGenres);
}
