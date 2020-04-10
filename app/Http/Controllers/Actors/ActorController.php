<?php

namespace App\Http\Controllers\Actors;

use App\Http\Controllers\Controller;
use App\ViewModels\Actors\ActorsViewModel;
use App\ViewModels\Actors\ActorViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActorController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request->page) && ($request->page < 1 || $request->page > 100)) {
            return redirect()->route('actors.index');
        }

        $popularActors = Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url').'/person/popular'.($request->page ? '?page='.$request->page : ''))
        ->json();

        return view('actors.index', new ActorsViewModel($popularActors, $request->page));
    }

    public function show($id)
    {
        $actor = Http::withToken(config('services.tmdb.token'))
        ->get(config('services.tmdb.url').'/person/'.$id.'?append_to_response=images,tagged_images,external_ids,combined_credits')
        ->json();

        $actor['images']['profiles'] = collect($actor['images']['profiles'])->take(10);
        $actor['tagged_images']['results'] = collect($actor['tagged_images']['results'])->take(10); 

        return view('actors.show', new ActorViewModel($actor));
    }
}
