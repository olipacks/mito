<!-- Top section -->
<div class="flex-shrink-0 bg-white">
    <!-- Toolbar-->
    <div class="h-16 flex flex-col justify-center">
        <div class="px-4 sm:px-6">
            @if ($post->isDraft())
                <form wire:submit.prevent="publish" class="py-3 flex flex-col">
                    <x-mito::button :disabled="$post->isEmpty()">
                        <x-mito::icon.check class="h-5 w-5 mr-2.5" />
                        <span>Publish</span>
                    </x-mito::button>
                </form>
            @else
                <div class="flex justify-end">
                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                        Published
                    </span>
                </div>
            @endif
        </div>
   </div>
</div>
<div class="min-h-0 flex-1 overflow-y-auto">
    <div class="bg-white py-5 px-6 min-h-full">
        <x-mito-markdown class="prose prose-sm" flavor="github">{!! $post->markdown !!}</x-mito-markdown>
    </div>
</div>
