<div x-data="{ isOpen: false }">
    <div class="mt-8">
        <a role="button" x-on:click="isOpen = true">
            <img src="{{ $link }}" alt="backdrop" class="hover:opacity-75 transition ease-in-out duration-150">
        </a>
    </div>

    <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center" x-show.transition.opacity="isOpen">
        <div class="modal-overlay absolute w-full h-full bg-gray-800 opacity-50"></div>
        
        <div class="container mx-auto lg:px-32 z-50 rounded-lg overflow-y-auto px-8">
            <div class="bg-gray-900 rounded" x-on:click.away="isOpen = false">
                <div class="relative px-4 py-2">
                    <button
                        x-on:click="isOpen = false"
                        x-on:keydown.escape.window="isOpen = false"
                        class="text-3xl leading-none hover:text-gray-300 absolute top-0 right-0 mr-4 mt-2">&times;
                    </button>
                </div>
                <div class="modal-body px-4 py-8">
                    <img src="{{ $link }}" alt="backdrop" class="w-full h-full">
                </div>
            </div>
        </div>
    </div>
</div>