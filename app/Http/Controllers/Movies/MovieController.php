<?php

namespace App\Http\Controllers\Movies;

use App\Http\Controllers\Controller;
use App\ViewModels\Movies\MovieViewModel;
use App\ViewModels\Movies\MoviesViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url').'/movie/popular')
        ->json();

        $genres = Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url').'/genre/movie/list')
        ->json()['genres'];

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url').'/movie/now_playing')
        ->json();

        return view('movies.index', new MoviesViewModel($popularMovies, $nowPlayingMovies, $genres));
    }

    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url').'/movie/'.$id.'?append_to_response=credits,videos,images,similar')
        ->json();

        $genres = Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url').'/genre/movie/list')
        ->json()['genres'];

        $movie['images']['backdrops'] = collect($movie['images']['backdrops'])->take(9);
        $movie['similar']['results'] = collect($movie['similar']['results'])->take(10);

        return view('movies.show', new MovieViewModel($movie, $genres));
    }
}
