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

    public function test_tv_show_show_correct_info()
    {
        $this->loginWithFakeUser();

        Http::fake([
            'https://api.themoviedb.org/3/tv/*' => $this->fakeSingleTVShow(),
            'https://api.themoviedb.org/3/genres/tv/list' => $this->fakeGenres(),
        ]);

        $response = $this->get(route('tv_shows.show', '1234'));

        $response->assertSuccessful();
    }

    private function fakeSingleTVShow()
    {
        return Http::response([
            'created_by' => [
                [
                    'name' => 'Maarten Moerkerke'
                ]
            ],
            'first_air_date' => '2020-01-02',
            'genres' => [
                [
                    'id' =>  18,
                    'name' => 'Drama'
                ],
                [
                    'id' => 10759,
                    'name' => 'Action & Adventure'
                ],
                [
                    'id' => 9648,
                    'name' => 'Mystery'
                ]
            ],
            'id' => 93533,
            'name' => 'Thieves of the Wood',
            'overview' => 'Charismatic highwayman Jan de Lichte leads the oppressed and downtrodden in a revolt against the corrupt aristocracy of 18th-century Belgium.',
            'poster_path' => '/jQNOzoiaIQWxJAx8OUighnvnhRA.jpg',
            'vote_average' => 5.9,
            'credits' => [
                'cast' => [
                    [
                        'character' => 'Tincke',
                        'credit_id' => '5d7ab545af43243b22975d99',
                        'id' => 231643,
                        'name' => 'Stef Aerts',
                        'gender' => 0,
                        'profile_path' => '/5O78BU3wfvL3WmcK1NQYrTKkzbR.jpg',
                        'order' => 500
                    ]
                ]
            ],
            'images' => [
                'backdrops' => [
                    [
                        'aspect_ratio' => 1.777777777777778,
                        'file_path' => '/gVVaukIifGJD78llZKgyT5FQbAe.jpg',
                        'height' => 1152,
                        'iso_639_1' => null,
                        'vote_average' => 5.384,
                        'vote_count' => 2,
                        'width' => 2048
                    ]
                ]
            ],
            'similar' => [
                'results' => [
                    [
                        'id' => 88118,
                        'name' => 'Blood & Treasure',
                        'first_air_date' => '2019-05-21',
                        'poster_path' => '/xbWqfPKBhqOZQEGq7HdDkX0Bjib.jpg',
                        'genre_ids' => [
                            18,
                            10759
                        ],
                        'overview' => 'An antiquities expert teams up with an art thief to catch a terrorist who funds his attacks using stolen artifacts.',
                        'vote_average' => 6.9,
                    ]
                ],
                'page' => 1,
                'total_pages' => 5,
                'total_results' => 98
            ],
            'videos' => [
                'results' => [
                    [
                        'key' => '6C_dBiXsaos',
                    ]
                ]
            ]
        ]);
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
