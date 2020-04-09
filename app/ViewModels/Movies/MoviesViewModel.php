<?php

namespace App\ViewModels\Movies;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $nowPlayingMovies;
    public $genres;

    public function __construct($popularMovies, $nowPlayingMovies, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->genres = $genres;
    }

    public function popularMovies()
    {
        $this->popularMovies['results'] = $this->formatMovies($this->popularMovies['results']);

        return $this->popularMovies;
    }

    public function nowPlayingMovies()
    {
        $this->nowPlayingMovies['results'] = $this->formatMovies($this->nowPlayingMovies['results']);

        return $this->nowPlayingMovies;
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });;
    }

    private function formatMovies($movies)
    {
        return collect($movies)->take(10)->map(function ($movie) {
            $genreFormatted = collect($movie['genre_ids'])->mapWithKeys(function ($genre) {
                return [
                    $genre => $this->genres()->get($genre)
                ];
            })->implode(', ');

            return collect($movie)->merge([
                'poster_path' => config('services.tmdb.image_url').$movie['poster_path'],
                'vote_average' => ($movie['vote_average'] * 10).'%',
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $genreFormatted
            ])->only([
                'poster_path', 'genre_ids', 'id', 'title', 'vote_average', 'overview', 'release_date', 'genres'
            ]);
        });
    }
}
