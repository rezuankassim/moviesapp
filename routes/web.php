<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('movies.index');
})->middleware('auth');

Route::group([
    'namespace' => 'Movies',
    'prefix' => 'movies',
    'middleware' => 'auth'
], function () {
    Route::get('/', 'MovieController@index')->name('movies.index');
    Route::get('/{id}', 'MovieController@show')->name('movies.show');
});

Route::group([
    'namespace' => 'Actors',
    'prefix' => 'actors',
    'middleware' => 'auth'
], function () {
    Route::get('/', 'ActorController@index')->name('actors.index');
    Route::get('/{id}', 'ActorController@show')->name('actors.show');
});

Route::group([
    'namespace' => 'TVShows',
    'prefix' => 'tv_shows',
    'middleware' => 'auth'
], function () {
    Route::get('/', 'TVShowController@index')->name('tv_shows.index');
    Route::get('/{id}', 'TVShowController@show')->name('tv_shows.show');
});

Auth::routes();