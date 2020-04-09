<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{
    /** @test */
    public function the_main_page_show_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular' => $this->fakePopularMovies(),
            'https://api.themoviedb.org/3/movie/now_playing' => $this->fakeNowPlayingMovies(),
            'https://api.themoviedb.org/3/genre/movie/list' => $this->fakeGenres(),
        ]);

        $response = $this->get(route('movies.index'));

        $response->assertSuccessful();
        $response->assertSee('Popular Movies');
        $response->assertSee('John Wick');
        $response->assertSee('Action');
        $response->assertSee('Thriller');
        $response->assertSee('Now Playing');
        $response->assertSee('Bloodshot');
    }

    /** @test */
    public function the_movie_page_show_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/*' => $this->fakeSingleMovie(),
            'https://api.themoviedb.org/3/genre/movie/list' => $this->fakeGenres(),
        ]);

       $response = $this->get(route('movies.show', 12345));

        $response->assertSuccessful();
        $response->assertSee('Fake Jumanji: The Next Level');
        $response->assertSee('Casting Director');
        $response->assertSee('Jeanne McCarthy');
        $response->assertSee('I Spit on Your Grave III: Vengeance is Mine');
    }

    /** @test */
    public function the_search_dropdown_works_correctly()
    {
        Http::fake([
            'https:://api.themoviedb.org/3/search/multi?query=john' => $this->fakeSearchResult() 
        ]);

        Livewire::test('search-dropdown')
            ->assertDontSee('John Wick')
            ->set('search', 'john')
            ->assertSee('John Wick');
    }

    public function fakeSearchResult()
    {
        return Http::response([
            'results' => [
                [
                    "popularity" => 540.987,
                    "vote_count" => 12081,
                    "video" => false,
                    "poster_path" => "\/5vHssUeVe25bMrof1HyaPyWgaP.jpg",
                    "id" => 245891,
                    "adult" => false,
                    "backdrop_path" => "\/lvjRFFyNLdaMWIMYQvoebeO1JlF.jpg",
                    "original_language" => "en",
                    "original_title" => "John Wick",
                    "genre_ids" => [
                        28,
                        53
                    ],
                    "title" => "John Wick",
                    "vote_average" => 7.2,
                    "overview" => "Ex-hitman John Wick comes out of retirement to track down the gangsters that took everything from him.",
                    "release_date" => "2014-10-22"
                ]
            ],
        ]);
    }

    public function fakeSingleMovie()
    {
        return Http::response([
            "title" => "Fake Jumanji: The Next Level",
            "poster_path" => "/bB42KDdfWkOvmzmYkmK58ZlCa9P.jpg",
            "vote_average" => 6.8,
            "release_date" => "2019-12-04",
            "genres" => [
                ["id" => 28, "name" => "Action"],
                ["id" => 12, "name" => "Adventure"],
                ["id" => 35, "name" => "Comedy"],
                ["id" => 14, "name" => "Fantasy"],
            ],
            "overview" => "As the gang return to Jumanji to rescue one of their own, they discover that nothing is as they expect. The players will have to brave parts unknown and unexplored.",
            "credits" => [
                "cast" => [
                    [
                        "cast_id" => 2,
                        "character" => "Dr. Smolder Bravestone",
                        "credit_id" => "5aac3960c3a36846ea005147",
                        "gender" => 2,
                        "id" => 18918,
                        "name" => "Dwayne Johnson",
                        "order" => 0,
                        "profile_path" => "/kuqFzlYMc2IrsOyPznMd1FroeGq.jpg",
                    ]
                ],
                "crew" => [
                    [
                        "credit_id" => "5d51d4ff18b75100174608d8",
                        "department" => "Production",
                        "gender" => 1,
                        "id" => 546,
                        "job" => "Casting Director",
                        "name" => "Jeanne McCarthy",
                        "profile_path" => null,
                    ]
                ]
            ],
            "videos" => [
                "results" => [
                    [
                        "id" => "5d1a1a9b30aa3163c6c5fe57",
                        "iso_639_1" => "en",
                        "iso_3166_1" => "US",
                        "key" => "rBxcF-r9Ibs",
                        "name" => "JUMANJI: THE NEXT LEVEL - Official Trailer (HD)",
                        "site" => "YouTube",
                        "size" => 1080,
                        "type" => "Trailer",
                    ]
                ]
            ],
            "images" => [
                "backdrops" => [
                    [
                        "aspect_ratio" => 1.7777777777778,
                        "file_path" => "/hreiLoPysWG79TsyQgMzFKaOTF5.jpg",
                        "height" => 2160,
                        "iso_639_1" => null,
                        "vote_average" => 5.388,
                        "vote_count" => 4,
                        "width" => 3840,
                    ]
                ]
            ],
            "similar" => [
                "page" => 1,
                "total_pages" => 66,
                "total_results" => 1308,
                "results" => [
                    [
                        "adult" => false,
                        "backdrop_path" => null,
                        "genre_ids" => [
                          27,
                          53
                        ],
                        "id" => 357096,
                        "original_language" => "en",
                        "original_title" => "I Spit on Your Grave III: Vengeance is Mine",
                        "overview" => "Jennifer Hills is still tormented by the brutal sexual assault she endured years ago. She’s changed identities and cities, reluctantly joining a support group where she begins to piece together a new life. But when her new friend’s murderer goes free and the tales of serial rapists haunt her, Jennifer will hunt down the men responsible and do what the system won’t – make them pay for their crimes in the most horrific ways imaginable. Only this time, no jury may be able to save her.",
                        "poster_path" => "/jG5GDIcqiqHXkvINZSjyzBUO2vH.jpg",
                        "release_date" => "2015-10-01",
                        "title" => "I Spit on Your Grave III: Vengeance is Mine",
                        "video" => false,
                        "vote_average" => 5.3,
                        "vote_count" => 451,
                        "popularity" => 15.539
                    ],
                ]
            ]
        ], 200);
    }

    public function fakePopularMovies()
    {
        return Http::response([
            'results' => [
                [
                    "popularity" => 540.987,
                    "vote_count" => 12081,
                    "video" => false,
                    "poster_path" => "\/5vHssUeVe25bMrof1HyaPyWgaP.jpg",
                    "id" => 245891,
                    "adult" => false,
                    "backdrop_path" => "\/lvjRFFyNLdaMWIMYQvoebeO1JlF.jpg",
                    "original_language" => "en",
                    "original_title" => "John Wick",
                    "genre_ids" => [
                        28,
                        53
                    ],
                    "title" => "John Wick",
                    "vote_average" => 7.2,
                    "overview" => "Ex-hitman John Wick comes out of retirement to track down the gangsters that took everything from him.",
                    "release_date" => "2014-10-22"
                ]
            ],
        ]);
    }

    public function fakeNowPlayingMovies()
    {
        return Http::response([
            'results' => [
                [
                    "popularity" => 305.22,
                    "vote_count" => 1194,
                    "video" => false,
                    "poster_path" => "\/8WUVHemHFH2ZIP6NWkwlHWsyrEL.jpg",
                    "id" => 338762,
                    "adult" => false,
                    "backdrop_path" => "\/ocUrMYbdjknu2TwzMHKT9PBBQRw.jpg",
                    "original_language" => "en",
                    "original_title" => "Bloodshot",
                    "genre_ids" => [
                        28,
                        878
                    ],
                    "title" => "Bloodshot",
                    "vote_average" => 7.3,
                    "overview" => "After he and his wife are murdered, marine Ray Garrison is resurrected by a team of scientists. Enhanced with nanotechnology, he becomes a superhuman, biotech killing machine—'Bloodshot'. As Ray first trains with fellow super-soldiers, he cannot recall anything from his former life. But when his memories flood back and he remembers the man that killed both him and his wife, he breaks out of the facility to get revenge, only to discover that there's more to the conspiracy than he thought.",
                    "release_date" => "2020-02-20"
                ]
            ],
        ]);
    }

    public function fakeGenres()
    {
        return Http::response([
            'genres' => [
                [
                    "id" => 28,
                    "name" => "Action"
                ],
                [
                    "id" => 53,
                    "name" => "Thriller"
                ],
                [
                    "id" => 878,
                    "name" => "Science Fiction"
                ],
                [
                    "id" => 27,
                    "name" => "Horror"
                ],
            ],
        ]);
    }
}
