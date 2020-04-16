<?php

namespace App\ViewModels\TVShows;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TVShowViewModel extends ViewModel
{
    public $tvShow;
    public $genres;

    public function __construct($tvShow, $genres)
    {
        $this->tvShow = $tvShow;
        $this->genres = $genres;
    }

    public function tvShow()
    {
        return collect($this->tvShow)->merge([
            'poster_path' => config('services.tmdb.image_url') . $this->tvShow['poster_path'],
            'vote_average' => ($this->tvShow['vote_average'] * 10) . '%',
            'first_air_date' => Carbon::parse($this->tvShow['first_air_date'])->format('M d, Y'),
            'similar' => [
                'page' => $this->tvShow['similar']['page'],
                'results' => $this->formatTVShows($this->tvShow['similar']['results']),
                'total_pages' => $this->tvShow['similar']['total_pages'],
                'total_results' => $this->tvShow['similar']['total_results']
            ],
            'genres' => collect($this->tvShow['genres'])->pluck('name')->flatten()->implode(', '),
            'cast' => collect($this->tvShow['credits']['cast'])->take(10),
            'images' => collect($this->tvShow['images']['backdrops'])->take(9)->map(function ($image) {
                return collect($image)->merge([
                    'file_path' => config('services.tmdb.image_url') . $image['file_path']
                ]);
            }),
            'created_by' => collect($this->tvShow['created_by'])->map(function ($createdBy) {
                return collect($createdBy)->merge([
                    'job' => 'creator'
                ])->only([
                    'name', 'job'
                ]);
            })
        ])->only([
            'poster_path', 'id', 'genres', 'name', 'vote_average', 'first_air_date', 'similar', 'cast', 'videos', 'images', 'overview', 'created_by'
        ]);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatTVShows($tvShows)
    {
        return collect($tvShows)->take(10)->map(function ($tvShow) {
            $genreFormatted = collect($tvShow['genre_ids'])->mapWithKeys(function ($genre) {
                return [
                    $genre => $this->genres()->get($genre)
                ];
            })->implode(', ');

            return collect($tvShow)->merge([
                'poster_path' => config('services.tmdb.image_url').$tvShow['poster_path'],
                'vote_average' => ($tvShow['vote_average'] * 10).'%',
                'first_air_date' => Carbon::parse($tvShow['first_air_date'])->format('M d, Y'),
                'genres' => $genreFormatted
            ])->only([
                'poster_path', 'genre_ids', 'id', 'name', 'vote_average', 'overview', 'first_air_date', 'genres'
            ]);
        });
    }
}
