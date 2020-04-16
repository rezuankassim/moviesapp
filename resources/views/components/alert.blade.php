<div x-data="{ isShown: true }" x-init="setTimeout(() => {isShown = false}, 3000)">
    <div class="absolute top-0 right-0 mt-24 mr-4 {{ $backgroundColor }} {{ $textColor }} z-30 rounded" role="alert" x-show="isShown" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
        <div class="relative">
            <button class="absolute top-0 right-0 mr-2 mt-2 hover:{{ $hoverTextColor }}" @click="isShown = false">
                <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"/></svg>
            </button>
            <div class="p-4">
                <p class="font-bold">An error has occured</p>
                <p>{{ $errors->first() }}</p>
            </div>
        </div>
    </div>
</div>