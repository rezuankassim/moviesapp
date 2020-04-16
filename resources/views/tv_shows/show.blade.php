@extends('layouts.main')

@section('pageTitle', config('app.name').' - '.$tvShow['name'])

@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-8 md:px-4 py-16 md:flex">
            <img src="{{ $tvShow['poster_path'] }}" alt="poster" class="md:w-96 md:h-144">
            <div class="mt-4 md:mt-0 md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $tvShow['name'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
                    <svg class="fill-current text-orange-500 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/></svg>
                    <span class="ml-1">{{ $tvShow['vote_average'] }}</span>
                    <span class="mx-2"> | </span>
                    <span>{{ $tvShow['first_air_date'] }}</span>
                    <span class="mx-2"> | </span>
                    <span>{{ $tvShow['genres'] }}</span>
                </div>
                <p class="text-gray-300 mt-8">
                    {{ $tvShow['overview'] }}
                </p>
                <div class="mt-12">
                    <h4 class="text-white font-semibold">@lang('movies.featuredCrews')</h4>
                    <div class="flex mt-4">
                        @foreach ($tvShow['created_by'] as $createdBy)
                            <div class="mr-8">
                                <div>{{ $createdBy['name'] }}</div>
                                <div class="text-sm text-gray-400">{{ $createdBy['job'] }}</div>
                            </div>  
                        @endforeach
                        
                    </div>
                </div>
                @if (count($tvShow['videos']['results']) > 0)
                    <div class="mt-12">
                        <x-play-button :title="$tvShow['name']" :link="$tvShow['videos']['results'][0]['key']"/>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">@lang('movies.casts')</h2>
            <div class="grid gril-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
                @foreach ($tvShow['cast'] as $cast)
                    <div class="mt-8">
                        <a href="{{ route('actors.show', $cast['id']) }}">
                            <img src="{{ config('services.tmdb.image_url').$cast['profile_path'] }}" alt="poster" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('actors.show', $cast['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $cast['name'] }}</a>
                            <div class="text-gray-400 text-sm">
                                {{ $cast['character'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="movie-image border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">@lang('movies.images')</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-16">
                @foreach ($tvShow['images'] as $image)
                    <x-image :link="$image['file_path']"/>
                @endforeach
            </div>
        </div>
    </div>

    <div class="similar-movies border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">@lang('movies.similarMovies')</h2>
            <div class="grid gril-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
                @foreach ($tvShow['similar']['results'] as $tvShow)
                    <x-tv-show-card :tvShow="$tvShow"/>
                @endforeach
            </div>
        </div>
    </div>
@endsection