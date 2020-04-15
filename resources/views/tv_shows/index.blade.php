@extends('layouts.main')

@section('pageTitle', config('app.name').' - TV Shows')

@section('content')
<div class="container mx-auto px-4 pt-16 pb-16">
    <div class="popular-tvs">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">@lang('tvs.popularTVShows')</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
            @foreach ($popularTVShows['results'] as $tvShow)
                <x-tv-show-card :tvShow="$tvShow"/>
            @endforeach
        </div>
    </div>
    <div class="now-playing">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold mt-16">@lang('tvs.onAir')</h2>
        
        <div class="grid gril-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
            @foreach ($onAirTVShows['results'] as $tvShow)
                <x-tv-show-card :tvShow="$tvShow"/>
            @endforeach
        </div>
    </div>
</div>
@endsection