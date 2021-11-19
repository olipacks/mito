@php
$classes = 'w-full inline-flex items-center justify-center p-1.5 border text-sm leading-4 font-medium rounded-md disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none transition ease-in-out duration-150 border-transparent text-gray-600 bg-white hover:bg-gray-100 hover:text-gray-700 focus:border-purple-300 focus:shadow-outline-purple active:text-gray-800 active:bg-gray-50';
@endphp

<markdown-toolbar class="flex space-x-2" for="markdown">
    <md-bold x-ref="bold" role="button" class="{{ $classes }}" data-tippy-content="Add bold text <cmd-b>" data-tippy-delay="[300, 0]">
        <x-mito::icon.bold class="h-4 w-4" />
    </md-bold>

    <md-italic x-ref="italic" role="button" class="{{ $classes }}" data-tippy-content="Add italic text <cmd-i>" data-tippy-delay="[300, 0]">
        <x-mito::icon.italic class="h-4 w-4" />
    </md-italic>

    <md-quote x-ref="quote" role="button" class="{{ $classes }}" data-tippy-content="Insert a quote <cmd-shift-.>" data-tippy-delay="[300, 0]">
        <x-mito::icon.quote class="h-4 w-4" />
    </md-quote>

    <md-link x-ref="link" role="button" class="{{ $classes }}" data-tippy-content="Add a link <cmd-k>" data-tippy-delay="[300, 0]">
        <x-mito::icon.link class="h-4 w-4" />
    </md-link>
</markdown-toolbar>
