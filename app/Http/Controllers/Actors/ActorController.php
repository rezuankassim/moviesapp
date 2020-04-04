<?php

namespace App\Http\Controllers\Actors;

use App\Http\Controllers\Controller;

class ActorController extends Controller
{
    public function index()
    {
        return view('actors.index');
    }
}
