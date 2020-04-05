@extends('layouts.main')

@section('pageTitle', config('app.name') . ' - Movies')

@section('content')
    <div class="container mx-auto px-4 pt-16 pb-16">
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">@lang('movies.popularMovies')</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
                @foreach ($popularMovies['results'] as $movie)
                    <x-movie-card :movie="$movie" :genres="$genres"/>
                @endforeach
            </div>
        </div>
        <div class="now-playing">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold mt-16">@lang('movies.nowPlaying')</h2>
            
            <div class="grid gril-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
                @foreach ($nowPlayingMovies['results'] as $movie)
                    <x-movie-card :movie="$movie" :genres="$genres"/>
                @endforeach
            </div>
        </div>
    </div>
@endsection