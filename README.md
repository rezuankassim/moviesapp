## About MoviesApp

MoviesApp is a project following tutorial by Andre Madarang with some tweaks of my own. This is first of my project that I will be using tailwindcss instead of Bootstrap.

## Packages Used
- <a href="https://laravel.com">Laravel 7</a>
- <a href="https://jquery.com">JQuery</a>
- <a href="https://tailwindcss.com">Tailwind CSS</a>
- <a href="https://laravel-livewire.com/docs/installation">Livewire</a>
- <a href="https://github.com/aniftyco/tailwindcss-spinner">Tailwind CSS Spinner</a>
- <a href="https://github.com/alpinejs/alpine#event">AlpineJS</a>

## Services Used
- <a href="https://www.themoviedb.org">The Movie DB</a>

## Steps to Do When Setup
- Copy ```.env.example``` file to ```.env```
- Setup database in ```.env```
- Insert auth token from TMDB to field ```TMDB_TOKEN``` in ```.env``` (You may change the urls for TMDB in ```.env```)
- Run ```php artisan config:cache```
- Run ```php artisan migrate```
- Run ```npm install && npm run dev```