<?php

namespace App\Http\Controllers\TVs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TVController extends Controller
{
    public function index()
    {
        return view('tvs.index');
    }
}
