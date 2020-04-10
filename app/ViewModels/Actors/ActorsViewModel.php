<?php

namespace App\ViewModels\Actors;

use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{
    public $popularActors;
    public $page;

    public function __construct($popularActors, $page)
    {
        $this->popularActors = $popularActors;
        $this->page = $page;
    }

    public function popularActors()
    {
        $this->popularActors['results'] = $this->formatActors($this->popularActors['results']);

        return $this->popularActors;
    }

    public function previous()
    {
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next()
    {
        return $this->page != 0 ? $this->page < 100 ? $this->page + 1 : null : 2;
    }

    private function formatActors($actors)
    {
        return collect($actors)->take(15)->map(function ($actor) {
            return collect($actor)->merge([
                'profile_path' => $actor['profile_path'] ? config('services.tmdb.image_url').$actor['profile_path'] : config('services.ui-avatars.url').$actor['name'],
                'gender' => $actor['gender'] == 2 ? 'Male' : 'Female',
                'known_for' => collect($actor['known_for'])->take(3)->map(function ($movie) {
                    return isset($movie['name']) ? $movie['name'] : $movie['title'];
                })->implode(', ')
            ])->only([
                'id', 'profile_path', 'name', 'popularity', 'gender', 'known_for'   
            ]);
        });
    }
}
