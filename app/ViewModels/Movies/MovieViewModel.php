<?php

namespace App\ViewModels\Movies;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;
    public $genres;

    public function __construct($movie, $genres)
    {
        $this->movie = $movie;
        $this->genres = $genres;
    }

    public function movie()
    {
        return collect($this->movie)->merge([
            'poster_path' => config('services.tmdb.image_url').$this->movie['poster_path'],
            'vote_average' => ($this->movie['vote_average'] * 10).'%',
            'release_date' => Carbon::parse($this->movie['release_date'])->format('M d, Y'),
            'similar' => [
                'page' => $this->movie['similar']['page'],
                'results' => $this->formatMovies($this->movie['similar']['results']),
                'total_pages' => $this->movie['similar']['total_pages'],
                'total_results' => $this->movie['similar']['total_results']
            ],
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->movie['credits']['crew'])->take(3),
            'cast' => collect($this->movie['credits']['cast'])->take(10),
            'images' => collect($this->movie['images']['backdrops'])->take(9)->map(function ($image) {
                return collect($image)->merge([
                    'file_path' => config('services.tmdb.image_url').$image['file_path']
                ]);
            })
        ])->only([
            'poster_path', 'id', 'genres', 'title', 'vote_average', 'release_date', 'similar', 'crew', 'cast', 'videos', 'images', 'overview'
        ]);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });;
    }

    public function formatMovies($movies)
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
