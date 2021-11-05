<div class="flex-shrink-0 bg-white">
    <div class="h-14 px-3 flex flex-col justify-center">
        <h3 class="text-sm font-medium ml-3 text-gray-900">Preview</h3>
    </div>
</div>
<div class="min-h-0 flex-1 overflow-y-auto">
    <div class="bg-white py-5 px-6 min-h-full">
        <x-mito-markdown class="prose prose-sm" flavor="github">{!! $post->markdown !!}</x-mito-markdown>
    </div>
</div>
