@extends('layouts.main')

@section('pageTitle', config('app.name') . ' - Actors')

@section('content')
    <div class="container mx-auto px-4 py-16 pb-16">
        <div class="popular-actors">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">@lang('actors.popularActors')</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
                @foreach ($popularActors['results'] as $actor)
                    <x-actor-card :actor="$actor"/>
                @endforeach
            </div>
        </div>
    </div>
@endsection