<?php

namespace App\Http\Controllers\Movies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url').'/movie/popular')
        ->json();

        $genresArray = collect(Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url').'/genre/movie/list')
        ->json()['genres']);

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url').'/movie/now_playing')
        ->json();

        $genres = collect($genresArray)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });

        $popularMovies['results'] = collect($popularMovies['results'])->take(10);
        $nowPlayingMovies['results'] = collect($nowPlayingMovies['results'])->take(10);

        return view('movies.index', [
            'popularMovies' => $popularMovies,
            'nowPlayingMovies' => $nowPlayingMovies,
            'genres' => $genres
        ]);
    }

    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url').'/movie/'.$id.'?append_to_response=credits,videos,images,similar')
        ->json();

        $genresArray = collect(Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url').'/genre/movie/list')
        ->json()['genres']);

        $genres = collect($genresArray)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });

        $movie['credits']['cast'] = collect($movie['credits']['cast'])->take(10);
        $movie['credits']['crew'] = collect($movie['credits']['crew'])->take(3);
        $movie['images']['backdrops'] = collect($movie['images']['backdrops'])->take(9);
        $movie['similar']['results'] = collect($movie['similar']['results'])->take(10);
 
        return view('movies.show', [
            'movie' => $movie,
            'genres' => $genres
        ]);
    }
}
