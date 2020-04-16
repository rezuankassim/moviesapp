<?php

namespace App\Http\Controllers\TVShows;

use App\Http\Controllers\Controller;
use App\ViewModels\TVShows\TVShowsViewModel;
use App\ViewModels\TVShows\TVShowViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TVShowController extends Controller
{
    public function index()
    {
        $popularTVShows = Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url').'/tv/popular')
        ->json();

        $onAirTVShows = Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url').'/tv/on_the_air')
        ->json();

        $genres = Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url').'/genre/tv/list')
        ->json()['genres'];

        return view('tv_shows.index', new TVShowsViewModel($popularTVShows, $onAirTVShows, $genres));
    }

    public function show($id)
    {
        $tvShow = Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url').'/tv/'.$id.'?append_to_response=credits,videos,images,similar')
        ->json();

        $genres = Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url').'/genre/tv/list')
        ->json()['genres'];

        return view('tv_shows.show', new TVShowViewModel($tvShow, $genres));
    }
}
