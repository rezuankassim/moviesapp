<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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
});

Route::group([
    'namespace' => 'TVs',
    'prefix' => 'tvs',
], function () {
    Route::get('/', 'TVController@index')->name('tvs.index');
});
