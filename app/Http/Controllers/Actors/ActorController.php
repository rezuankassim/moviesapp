<?php

namespace App\Http\Controllers\Actors;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ActorController extends Controller
{
    public function index()
    {
        $popularActors = Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url').'/person/popular')
        ->json();

        $popularActors['results'] = collect($popularActors['results'])->take(10);

        return view('actors.index', [
            'popularActors' => $popularActors,
        ]);
    }

    public function show($id)
    {
        $actor = Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url').'/person/'.$id.'?append_to_response=images,tagged_images,external_ids')
        ->json();

        $actor['images']['profiles'] = collect($actor['images']['profiles'])->take(10);
        $actor['tagged_images']['results'] = collect($actor['tagged_images']['results'])->take(10); 

        return view('actors.show', [
            'actor' => $actor,
        ]);
    }
}
