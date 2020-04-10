<?php

namespace App\ViewModels\Actors;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $actor;

    public function __construct($actor)
    {
        $this->actor = $actor;
        $this->credits = $actor['combined_credits']['cast'];
    }

    public function actor()
    {
        return collect($this->actor)->merge([
            'profile_path' => config('services.tmdb.image_url').$this->actor['profile_path'],
            'also_known_as' => collect($this->actor['also_known_as'])->take(4)->implode(', '),
            'gender' => $this->actor['gender'] == 2 ? 'Male' : 'Female',
            'birthday_and_age' => Carbon::parse($this->actor['birthday'])->format('M d, Y') . 
                ($this->actor['deathday'] ? ' - '.Carbon::parse($this->actor['deathday'])->format('M d, Y').' ('.Carbon::parse($this->actor['birthday'])->age.')' 
                                          : ' ('.Carbon::parse($this->actor['birthday'])->age.')'),
            'external_ids' => collect($this->actor['external_ids'])->only(['facebook_id', 'instagram_id', 'twitter_id'])
        ])->only([
            'name', 'profile_path', 'also_known_as', 'gender', 'birthday_and_age', 'biography', 'external_ids', 'popularity'
        ]);
    }

    public function credits()
    {
        return collect($this->credits)->take(5)->map(function ($movie) {
            return collect($movie)->merge([
                'poster_path' => config('services.tmdb.image_url').$movie['poster_path'],
                'title' => isset($movie['name']) ? $movie['name'] : $movie['title']
            ]);
        })->sortBy('popularity');
    }
}
