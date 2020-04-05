<div x-data="{ isOpen: false }">
    <button x-on:click="isOpen = true" class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
        <svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"/></svg>
        <span class="ml-2">Play Trailer</span>
    </button>

    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center" x-show.transition.opacity="isOpen">
        <div class="modal-overlay absolute w-full h-full bg-gray-800 opacity-50"></div>
        
        <div class="container mx-auto lg:px-32 z-50 rounded-lg overflow-y-auto px-8">
            <div class="bg-gray-900 rounded" x-on:click.away="isOpen = false">
                <div class="flex justify-between item-centers px-4 py-4">
                    <span class="text-xl text-semibold">{{ $title }}</span>
                    <button
                        x-on:click="isOpen = false"
                        x-on:keydown.escape.window="isOpen = false"
                        class="text-3xl leading-none hover:text-gray-300">&times;
                    </button>
                </div>
                <div class="modal-body px-4 py-8">
                    <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $link }}" frameborder="0" class="responsive-iframe absolute top-0 left-0 w-full h-full border-0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>