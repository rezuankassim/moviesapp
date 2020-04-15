<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ViewTVShowsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tv_shows_index_show_correct_info()
    {
        $this->loginWithFakeUser();

        Http::fake([
            'https://api.themoviedb.org/3/tv/popular' => $this->fakePopularTVShows(),
            'https://api.themoviedb.org/3/tv/on_the_air' => $this->fakeOnTheAirTVShows(),
            'https://api.themoviedb.org/3/genre/tv/list' => $this->fakeGenres(),
        ]);

        $response = $this->get(route('tv_shows.index'));

        $response->assertSuccessful();
        $response->assertSee('Popular TV Shows');
        $response->assertSee('Westworld');
        $response->assertSee('Western');
        $response->assertSee('On Air TV Shows');
        $response->assertSee('Killing Eve');
        $response->assertSee('Crime');
        $response->assertSee('Drama');
    }

    private function fakePopularTVShows()
    {
        return Http::response([
            'results' => [
                [
                    'name' => 'Westworld',
                    'genre_ids' => [
                        37
                    ],
                    'id' => 63247,
                    'vote_average' => 8.2,
                    'first_air_date' => '2016-10-02',
                    'overview' => 'A dark odyssey about the dawn of artificial consciousness and the evolution of sin. Set at the intersection of the near future and the reimagined past, it explores a world in which every human appetite, no matter how noble or depraved, can be indulged.',
                    'poster_path' => '\/y55oBgf6bVMI7sFNXwJDrSIxPQt.jpg',
                ]
            ]
        ]);
    }

    private function fakeOnTheAirTVShows()
    {
        return Http::response([
            'results' => [
                [
                    'name' => 'Killing Eve',
                    'genre_ids' => [
                        80,
                        18
                    ],
                    'id' => 72750,
                    'vote_average' => 8.2,
                    'first_air_date' => '2016-10-02',
                    'overview' => 'A security consultant hunts for a ruthless assassin. Equally obsessed with each other, they go head to head in an epic game of cat-and-mouse.',
                    'poster_path' => '\/vNEROqZG3sMyMnnLmQ43TML5qFk.jpg',
                ]
            ]
        ]);
    }

    private function fakeGenres()
    {
        return Http::response([
            'genres' => [
                [
                    'id' => 37,
                    'name' => 'Western'
                ],
                [
                    'id' => 80,
                    'name' => 'Crime'
                ],
                [
                    'id' => 18,
                    'name' => 'Drama',
                ]
            ]
        ]);
    }
}
