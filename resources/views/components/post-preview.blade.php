<!-- Top section -->
<div class="flex-shrink-0 bg-white">
    <!-- Toolbar-->
    <div class="h-16 flex flex-col justify-center">
        <div class="px-4 sm:px-6">
            <div class="py-3 flex justify-end">
                <div>
                    <div class="flex space-x-3">
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
                                            <x-mito::icon.draft class="mr-2.5 -my-0.5 h-5 w-5 text-yellow-500" />
                                            Unpublished
                                        </div>
                                    @else
                                        <div class="flex items-center">
                                            <x-mito::icon.published class="mr-2.5 -my-0.5 h-5 w-5 text-purple-500" />
                                            Published
                                        </div>
                                    @endif
                                </x-mito::button>
                            </x-slot>

                            <x-slot name="content">
                                <x-mito::dropdown.link wire:click.prevent="unpublish" href="/" :active="$post->isDraft()">
                                    <div class="flex items-center">
                                        <x-mito::icon.draft class="mr-2.5 h-5 w-5 text-yellow-500" />
                                        Unpublished
                                    </div>
                                </x-mito::dropdown.link>

                                <x-mito::dropdown.link wire:click.prevent="publish" href="/" :active="$post->isPublished()">
                                    <div class="flex items-center">
                                        <x-mito::icon.published class="mr-2.5 h-5 w-5 text-purple-500" />
                                        Published
                                    </div>
                                </x-mito::dropdown.link>
                            </x-slot>
                        </x-mito::dropdown>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>
<div class="min-h-0 flex-1 overflow-y-auto">
    <div class="bg-white py-5 px-6 min-h-full">
        <x-mito-markdown class="prose prose-sm" flavor="github">{!! $post->markdown !!}</x-mito-markdown>
    </div>
</div>
