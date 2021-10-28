@if ($posts->count() > 0)
    <div class="flex-shrink-0">
        <div class="h-16 bg-white px-6 flex flex-col justify-center">
            <div class="flex items-baseline space-x-3">
                <h2 class="text-lg font-medium text-gray-900">
                    @if ($type === 'draft')
                        Drafts
                    @elseif ($type === 'published')
                        Published
                    @endif
                </h2>
                @if ($posts->count() === 1)
                    <p class="text-sm font-medium text-gray-500">{{ $posts->count() }} post</p>
                @elseif ($posts->count() > 1)
                    <p class="text-sm font-medium text-gray-500">{{ $posts->count() }} posts</p>
                @endif
            </div>
        </div>
        <div class="bg-white px-6 py-2">
            <form wire:submit.prevent="createDraft">
                <div class="flex flex-col">
                    <x-mito::button color="white">New Draft</x-mito::button>
                </div>
            </form>
        </div>
    </div>
    <nav aria-label="Post list" class="min-h-0 flex-1 overflow-y-auto px-3">
        <ul class="space-y-1">
            @foreach($posts as $post)
                <li class="relative py-5 px-3 {{ $post->is($currentPost) ? 'bg-gray-100' : 'bg-white hover:bg-gray-50' }} focus-within:ring-2 focus-within:ring-inset focus-within:ring-purple-600 rounded-md">
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
                        <time datetime="2021-01-27T16:35" class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">{{ $post->created_at->diffForHumans(null, null, true) }}</time>
                    </div>
                    @unless ($post->isEmpty())
                        <div class="mt-1">
                            <p class="line-clamp-2 text-sm text-gray-600">
                                {{ $post->lead }}
                            </p>
                        </div>
                    @endunless
                </li>
            @endforeach
        </ul>
    </nav>
@endif
