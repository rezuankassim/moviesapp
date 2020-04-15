<div class="mt-8">
    <a href="{{ route('tv_shows.show', $tvShow['id']) }}">
        <img src="{{ $tvShow['poster_path'] }}" alt="poster" class="hover:opacity-75 transition ease-in-out duration-150">
    </a>
    <div class="mt-2">
        <a href="{{ route('tv_shows.show', $tvShow['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $tvShow['name'] }}</a>
        <div class="flex items-center text-gray-400 text-sm mt-1">
            <svg class="fill-current text-orange-500 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/></svg>
            <span class="ml-1">{{ $tvShow['vote_average'] }}</span>
            <span class="mx-2"> | </span>
            <span>{{ $tvShow['first_air_date'] }}</span>
        </div>
        <div class="text-gray-400 text-sm">{{ $tvShow['genres'] }}</div>
    </div>
</div>