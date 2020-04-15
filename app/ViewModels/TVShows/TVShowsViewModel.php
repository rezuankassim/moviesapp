<?php

namespace App\ViewModels\TVShows;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TVShowsViewModel extends ViewModel
{
    public $popularTVShows;
    public $onAirTVShows;
    public $genres;

    public function __construct($popularTVShows, $onAirTVShows, $genres)
    {
        $this->popularTVShows = $popularTVShows;
        $this->onAirTVShows = $onAirTVShows;
        $this->genres = $genres;
    }

    public function popularTVShows()
    {
        $this->popularTVShows['results'] = $this->formatTVShows($this->popularTVShows['results']);

        return $this->popularTVShows;
    }

    public function onAirTVShows()
    {
        $this->onAirTVShows['results'] = $this->formatTVShows($this->onAirTVShows['results']);

        return $this->onAirTVShows;
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });;
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
                'poster_path', 'id', 'name', 'vote_average', 'overview', 'first_air_date', 'genres'
            ]);
        });
    }
}
