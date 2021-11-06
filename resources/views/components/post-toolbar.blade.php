<div class="flex-shrink-0 bg-white">
    <div class="h-14 px-3 flex flex-col justify-center">
        <div class="flex justify-between">
            <div>
                <div class="block xl:hidden flex space-x-3">
                    <x-mito::button.icon color="transparent" href="{{ route('mito.posts.index') . '?type=' . $post->status }}" color="transparent" :disabled="! $post->isDirty('markdown')">
                        <x-mito::icon.back class="h-4 w-4" />
                    </x-mito::button.icon>
                </div>
            </div>
            <div>
                <div class="flex items-center space-x-3">
                    @if ($post->isPublished())
                        <form wire:submit.prevent="save">
                            <x-mito::button color="transparent" :disabled="! $post->isDirty('markdown')">
                                <span>Save changes</span>
                            </x-mito::button>
                        </form>
                    @endif
                    <x-mito::dropdown>
                        <x-slot name="trigger">
                            <x-mito::button color="transparent">
                                @if ($post->isDraft())
                                    <div class="flex items-center">
                                        Unpublished
                                    </div>
                                @else
                                    <div class="flex items-center">
                                        <x-mito::icon.published class="mr-2.5 h-4 w-4" />
                                        Published
                                    </div>
                                @endif
                            </x-mito::button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="space-y-1">
                                <x-mito::dropdown.link wire:click.prevent="unpublish" href="/" :active="$post->isDraft()">
                                    <div class="flex items-center">
                                        <x-mito::icon.draft class="mr-2.5 h-4 w-4" />
                                        Unpublished
                                    </div>
                                </x-mito::dropdown.link>
                                <x-mito::dropdown.link wire:click.prevent="publish" href="/" :active="$post->isPublished()">
                                    <div class="flex items-center">
                                        <x-mito::icon.published class="mr-2.5 h-4 w-4" />
                                        Published
                                    </div>
                                </x-mito::dropdown.link>
                            </div>
                        </x-slot>
                    </x-mito::dropdown>
                    <x-mito::button.icon color="transparent" wire:click="$emit('openModal', 'mito::posts.manage-post-settings', {{ json_encode(['post' => $post->id]) }})">
                        <x-mito::icon.settings class="h-4 w-4" />
                    </x-mito::button.icon>
                </div>
            </div>
        </div>
    </div>
</div>
