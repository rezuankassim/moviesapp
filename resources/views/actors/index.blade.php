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

        <div class="mt-16 border-t border-gray-700">
            <div class="flex justify-between mt-4">
                @if ($previous)
                    <a href="{{ route('actors.index', ['page' => $previous]) }}" class="flex items-center hover:text-gray-300">
                        <svg class="fill-current w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z"/></svg>
                        
                        <span class="ml-2">Previous</span>
                    </a>
                @else
                    <button class="flex items-center cursor-not-allowed text-gray-600">
                        <svg class="fill-current w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z"/></svg>
                        
                        <span class="ml-2">Previous</span>
                    </button>
                @endif
                
                @if ($next)
                    <a href="{{ route('actors.index', ['page' => $next]) }}" class="flex items-center hover:text-gray-300">
                        <span class="mr-2">Next</span>

                        <svg class="fill-current w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"/></svg>
                    </a>
                @else
                    <button class="flex items-center cursor-not-allowed text-gray-600">
                        <span class="mr-2">Next</span>

                        <svg class="fill-current w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"/></svg>
                    </button>
                @endif
                
            </div>
        </div>
    </div>
@endsection