@extends('layouts.main')

@section('pageTitle', config('app.name').' - '.$actor['name'])

@section('content')
    <div class="actor-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 md:flex">
            <img src="{{ config('services.tmdb.image_url').$actor['profile_path'] }}" alt="profile" class="md:w-96 md:h-144">
            <div class="mt-4 md:mt-0 md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $actor['name'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    @foreach ($actor['also_known_as'] as $name)
                        {{ $name }}{{ $loop->last ? '' : ',' }}
                    @endforeach
                </div>
                <div class="flex flex-wrap items-center mt-4">
                    <svg class="fill-current text-orange-500 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/></svg>
                    <span class="ml-1">{{ $actor['popularity'] }}</span>
                    <span class="mx-2"> | </span>
                    <span>{{ $actor['gender'] == 2 ? 'Male' : 'Female' }}</span>
                    @if ($actor['birthday'])
                        <span class="mx-2"> | </span>
                        <span>{{ Carbon\Carbon::parse($actor['birthday'])->format('M d, Y') }}</span>
                        @if ($actor['deathday'])
                            <span>{{ ' - '.Carbon\Carbon::parse($actor['deathday'])->format('M d, Y')}}</span>
                        @endif
                        <span class="ml-2">{{ '('.Carbon\Carbon::parse($actor['birthday'])->age.')' }}</span>
                    @endif
                </div>
                <div class="mt-4">
                    {{ $actor['biography'] }}
                </div>
                <div class="flex flex-wrap items-center mt-4">
                    @if ($actor['external_ids']['facebook_id'])
                        <a href="https://www.facebook.com/{{ $actor['external_ids']['facebook_id'] }}" class="mr-2" target="_blank">
                            <svg class="fill-current text-orange-500 w-6 hover:text-orange-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M400 32H48A48 48 0 000 80v352a48 48 0 0048 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0048-48V80a48 48 0 00-48-48z"/></svg>
                        </a>
                    @endif
                    @if ($actor['external_ids']['instagram_id'])
                        <a href="https://www.instagram.com/{{ $actor['external_ids']['instagram_id'] }}" class="mr-2" target="_blank">
                            <svg class="fill-current text-orange-500 w-6 hover:text-orange-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224 202.66A53.34 53.34 0 10277.36 256 53.38 53.38 0 00224 202.66zm124.71-41a54 54 0 00-30.41-30.41c-21-8.29-71-6.43-94.3-6.43s-73.25-1.93-94.31 6.43a54 54 0 00-30.41 30.41c-8.28 21-6.43 71.05-6.43 94.33s-1.85 73.27 6.47 94.34a54 54 0 0030.41 30.41c21 8.29 71 6.43 94.31 6.43s73.24 1.93 94.3-6.43a54 54 0 0030.41-30.41c8.35-21 6.43-71.05 6.43-94.33s1.92-73.26-6.43-94.33zM224 338a82 82 0 1182-82 81.9 81.9 0 01-82 82zm85.38-148.3a19.14 19.14 0 1119.13-19.14 19.1 19.1 0 01-19.09 19.18zM400 32H48A48 48 0 000 80v352a48 48 0 0048 48h352a48 48 0 0048-48V80a48 48 0 00-48-48zm-17.12 290c-1.29 25.63-7.14 48.34-25.85 67s-41.4 24.63-67 25.85c-26.41 1.49-105.59 1.49-132 0-25.63-1.29-48.26-7.15-67-25.85s-24.63-41.42-25.85-67c-1.49-26.42-1.49-105.61 0-132 1.29-25.63 7.07-48.34 25.85-67s41.47-24.56 67-25.78c26.41-1.49 105.59-1.49 132 0 25.63 1.29 48.33 7.15 67 25.85s24.63 41.42 25.85 67.05c1.49 26.32 1.49 105.44 0 131.88z"/></svg>
                        </a>
                    @endif
                    @if ($actor['external_ids']['twitter_id'])
                        <a href="https://twitter.com/{{ $actor['external_ids']['twitter_id'] }}" class="mr-2" target="_blank">
                            <svg class="fill-current text-orange-500 w-6 hover:text-orange-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm-48.9 158.8c.2 2.8.2 5.7.2 8.5 0 86.7-66 186.6-186.6 186.6-37.2 0-71.7-10.8-100.7-29.4 5.3.6 10.4.8 15.8.8 30.7 0 58.9-10.4 81.4-28-28.8-.6-53-19.5-61.3-45.5 10.1 1.5 19.2 1.5 29.6-1.2-30-6.1-52.5-32.5-52.5-64.4v-.8c8.7 4.9 18.9 7.9 29.6 8.3a65.447 65.447 0 01-29.2-54.6c0-12.2 3.2-23.4 8.9-33.1 32.3 39.8 80.8 65.8 135.2 68.6-9.3-44.5 24-80.6 64-80.6 18.9 0 35.9 7.9 47.9 20.7 14.8-2.8 29-8.3 41.6-15.8-4.9 15.2-15.2 28-28.8 36.1 13.2-1.4 26-5.1 37.8-10.2-8.9 13.1-20.1 24.7-32.9 34z"/></svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">@lang('movies.casts')</h2>
            <div class="grid gril-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
                @foreach ($movie['credits']['cast'] as $cast)
                    <div class="mt-8">
                        <a href="#">
                            <img src="{{ config('services.tmdb.image_url').$cast['profile_path'] }}" alt="poster" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="mt-2">
                            <a href="#" class="text-lg mt-2 hover:text-gray-300">{{ $cast['name'] }}</a>
                            <div class="text-gray-400 text-sm">
                                {{ $cast['character'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div> --}}
@endsection