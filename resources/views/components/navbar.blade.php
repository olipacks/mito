@props([
    'currentType' => null,
    'links' => [
        ['Drafts', route('mito.posts.index') . '?type=draft', $currentType === 'draft'],
        ['Published', route('mito.posts.index') . '?type=published', $currentType === 'published'],
    ],
])

<header x-data="{ open: false }" @keydown.window.escape="open = false" class="flex-shrink-0 relative h-16 bg-white flex items-center">
    <!-- Menu button area -->
    <div class="absolute inset-y-0 right-0 pr-4 flex items-center sm:pr-6 lg:hidden">
        <!-- Mobile menu button -->
        <button @click="open = true" type="button" class="-mr-2 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-purple-600">
            <span class="sr-only">Open main menu</span>
            <!-- Heroicon name: outline/menu -->
            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Desktop nav area -->
    <div class="hidden lg:min-w-0 lg:flex-1 lg:flex lg:items-center lg:justify-between">
        <div class="hidden lg:block lg:ml-3">
            <div class="flex space-x-4">
                @foreach ($links as list($title, $link, $active))
                    <a
                        href="{{ $link }}"
                        class="{{ $active ? 'bg-gray-100' : 'hover:text-gray-700' }} px-3 py-2 rounded-md text-sm font-medium text-gray-900"
                    >
                        {{ $title }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <x-mito::mobile-menu :links="$links" />
</header>
