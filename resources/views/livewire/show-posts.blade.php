<x-mito::show-posts-layout>
    <x-slot name="leftColumn">
        <x-mito::post-list :currentType="$type" :posts="$posts" />
    </x-slot>

    <x-slot name="rightColumn">
        @if ($posts->count() > 0)
            <div class="min-h-full pt-5 pb-6 relative flex items-center justify-center">
                <div class="text-center">
                    <h3 class="mt-2 text-sm font-medium text-gray-900">
                        @if ($type === 'draft')
                            No draft selected
                        @elseif ($type === 'published')
                            No post selected
                        @endif
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        @if ($type === 'draft')
                            Select a draft or get started by creating a new draft.
                        @elseif ($type === 'published')
                            Select a post or get started by creating a new draft.
                        @endif
                    </p>
                    <div class="mt-6">
                        <form wire:submit.prevent="createDraft">
                            <x-mito::button color="white">
                                <x-mito::icon.plus class="-ml-1 mr-2 h-4 w-4" />
                                New Draft
                            </x-mito::button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="min-h-full pt-5 pb-6 relative flex items-center justify-center">
                <div class="text-center">
                    <h3 class="mt-2 text-sm font-medium text-gray-900">
                        @if ($type === 'draft')
                            No drafts
                        @elseif ($type === 'published')
                            No published posts
                        @endif
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Get started by creating a new draft.
                    </p>
                    <div class="mt-6">
                        <form wire:submit.prevent="createDraft">
                            <x-mito::button color="primary">
                                <x-mito::icon.plus class="-ml-1 mr-2 h-5 w-5" />
                                New Draft
                            </x-mito::button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </x-slot>
</x-mito::post-layout>
