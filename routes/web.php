<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('movies.index');
});

Route::group([
    'namespace' => 'Movies',
    'prefix' => 'movies',
], function () {
    Route::get('/', 'MovieController@index')->name('movies.index');
    Route::get('/{id}', 'MovieController@show')->name('movies.show');
});

Route::group([
    'namespace' => 'Actors',
    'prefix' => 'actors',
], function () {
    Route::get('/', 'ActorController@index')->name('actors.index');
    Route::get('/{id}', 'ActorController@show')->name('actors.show');
});

Route::group([
    'namespace' => 'TVs',
    'prefix' => 'tvs',
], function () {
    Route::get('/', 'TVController@index')->name('tvs.index');
});
