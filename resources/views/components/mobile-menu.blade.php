<div x-show="open" class="fixed inset-0 z-40 lg:hidden" role="dialog" aria-modal="true">
    <div x-show="open" @click="open = false" class="hidden sm:block sm:fixed sm:inset-0 sm:bg-gray-600 sm:bg-opacity-75" aria-hidden="true"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"></div>
    <nav x-show="open" class="fixed z-40 inset-0 h-full w-full bg-white sm:inset-y-0 sm:left-auto sm:right-0 sm:max-w-sm sm:w-full sm:shadow-lg" aria-label="Global"
        x-transition:enter="transition ease-out duration-150 sm:ease-in-out sm:duration-300"
        x-transition:enter-start="transform opacity-0 scale-110 sm:translate-x-full sm:scale-100 sm:opacity-100"
        x-transition:enter-end="transform opacity-100 scale-100 sm:translate-x-0 sm:scale-100 sm:opacity-100"
        x-transition:leave="transition ease-in duration-150 sm:ease-in-out sm:duration-300"
        x-transition:leave-start="transform opacity-100 scale-100 sm:translate-x-0 sm:scale-100 sm:opacity-100"
        x-transition:leave-end="transform opacity-0 scale-110 sm:translate-x-full sm:scale-100 sm:opacity-100">
        <div class="h-16 flex items-center justify-end px-4 sm:px-6">
            <button @click="open = false" type="button" class="-mr-2 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-purple-600">
                <span class="sr-only">Close main menu</span>
                <!-- Heroicon name: outline/x -->
                <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="max-w-8xl mx-auto py-3 px-2 sm:px-4">
            @foreach ($links as list($title, $link, $active))
                <a
                    href="{{ $link }}"
                    class="block rounded-md py-2 px-3 text-base font-medium text-gray-900 hover:bg-gray-100"
                >
                    {{ $title }}
                </a>
            @endforeach
        </div>
    </nav>
</div>
