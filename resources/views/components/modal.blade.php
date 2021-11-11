<div class="px-4 pt-5 pb-4 sm:p-6">
    <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
        <button wire:click="$emit('closeModal')" type="button" class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
            <span class="sr-only">Close</span>
            <!-- Heroicon name: outline/x -->
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    @if(isset($title))
        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-5 sm:mb-6">
            {{ $title }}
        </h3>
    @endif

    {{ $content }}
</div>
