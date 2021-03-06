@props([
    'posts',
    'currentType',
    'currentPost' => null,
    'links' => [
        ['Drafts', route('mito.posts.index') . '?type=draft', $currentType === 'draft'],
        ['Scheduled', route('mito.posts.index') . '?type=scheduled', $currentType === 'scheduled'],
        ['Published', route('mito.posts.index') . '?type=published', $currentType === 'published'],
    ],
])

<div class="flex-shrink-0">
    <div class="h-14 bg-white px-3 flex flex-col justify-center">
        <div class="flex justify-between">
            @foreach ($links as list($title, $link, $active))
                <a
                    href="{{ $link }}"
                    class="{{ $active ? 'bg-gray-800 text-white' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-800' }} px-2.5 py-1.5 rounded-md text-sm font-medium"
                >
                    {{ $title }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="bg-white p-3">
        <form wire:submit.prevent="createDraft">
            <div class="flex flex-col">
                <x-mito::button color="white">
                    <x-mito::icon.plus class="-ml-1 mr-2 h-4 w-4" />
                    New Draft
                </x-mito::button>
            </div>
        </form>
    </div>
</div>

@if ($posts->count() > 0)
    <nav aria-label="Post list" class="min-h-0 flex-1 overflow-y-auto p-3">
        <ul class="space-y-1">
            @foreach($posts as $post)
                <li class="relative py-5 px-3 {{ $post->is($currentPost) ? 'bg-gray-200' : 'bg-white hover:bg-gray-100' }} focus-within:ring-2 focus-within:ring-inset focus-within:ring-purple-600 rounded-md">
                    <div class="flex justify-between space-x-3">
                        <div class="min-w-0 flex-1">
                            <a href="{{ route('mito.posts.edit', $post) }}" class="block focus:outline-none">
                                <span class="absolute inset-0" aria-hidden="true"></span>
                                @if ($post->isEmpty())
                                    <p class="text-sm text-gray-500 truncate">Empty draft...</p>
                                @else
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $post->title }}</p>
                                @endif
                            </a>
                        </div>
                        @if ($post->isDraft())
                            <time datetime="{{ $post->created_at->format('Y-m-d') }}" class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">{{ $post->created_at->diffForHumans(null, null, true) }}</time>
                        @else
                            <time datetime="{{ $post->published_at->format('Y-m-d') }}" class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">{{ $post->published_at->diffForHumans(null, null, true) }}</time>
                        @endif
                    </div>
                    @unless ($post->isEmpty())
                        <div class="mt-1">
                            <p class="line-clamp-2 text-sm text-gray-600">
                                {{ $post->excerpt }}
                            </p>
                        </div>
                    @endunless
                </li>
            @endforeach
        </ul>
    </nav>
@endif
