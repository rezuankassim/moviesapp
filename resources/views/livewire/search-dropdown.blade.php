<div class="relative" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <input wire:model.debounce.500ms="search" type="text" class="bg-gray-800 text-sm rounded-full w-64 px-4 pl-8 py-1" placeholder="Search" @focus="isOpen = true">

    <div class="absolute top-0 text-gray-500">
        <svg class="fill-current w-3 mt-2 ml-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"/></svg>
    </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-4"></div>

    @if (strlen($search) >= 2)
        <div class="z-10 absolute bg-gray-800 text-sm rounded mt-2 w-64" x-show="isOpen" @keydown.escape.window="isOpen = false">
            @if ($searchResults->count() > 0)
                <ul>
                    @foreach ($searchResults as $result)
                        @if (isset($result['media_type']) && $result['media_type'] == 'movie')
                            <li class="border-b border-gray-700">
                                <a href="{{ route('movies.show', $result['id']) }}" class="block hover:border-gray-700 px-3 py-3 flex items-center">
                                    @if ($result['poster_path'])
                                        <img src="{{ config('services.tmdb.image_url').$result['poster_path'] }}" alt="poster" class="w-8">
                                    @else
                                        <img src="{{ asset('storage/uploads/defaults/50x75.png') }}" alt="poster" class="w-8">
                                    @endif
                                    
                                    <span class="ml-4">{{ $result['title'] }}</span>
                                </a>
                            </li>
                        @elseif (isset($result['media_type']) && $result['media_type'] == 'tv')
                            <li class="border-b border-gray-700">
                                <a href="#" class="block hover:border-gray-700 px-3 py-3 flex items-center">
                                    @if ($result['poster_path'])
                                        <img src="{{ config('services.tmdb.image_url').$result['poster_path'] }}" alt="poster" class="w-8">
                                    @else
                                        <img src="{{ asset('storage/uploads/defaults/50x75.png') }}" alt="poster" class="w-8">
                                    @endif
                                    <span class="ml-4">{{ $result['name'] }}</span>
                                </a>
                            </li>
                        @else
                            <li class="border-b border-gray-700">
                                <a href="{{ route('actors.show', $result['id']) }}" class="block hover:border-gray-700 px-3 py-3 flex items-center">
                                    @if ($result['profile_path'])
                                        <img src="{{ config('services.tmdb.image_url').$result['profile_path'] }}" alt="profile" class="w-8">
                                    @else
                                        <img src="{{ asset('storage/uploads/defaults/50x75.png') }}" alt="profile" class="w-8">
                                    @endif
                                    <span class="ml-4">{{ $result['name'] }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">No results for "{{ $search }}"</div>
            @endif
            
        </div>
    @endif
</div>
