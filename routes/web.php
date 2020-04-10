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
    'namespace' => 'TVs',
    'prefix' => 'tvs',
    'middleware' => 'auth'
], function () {
    Route::get('/', 'TVController@index')->name('tvs.index');
});

Auth::routes();