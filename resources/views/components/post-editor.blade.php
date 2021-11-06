@php
$classes = 'text-sm w-full min-h-full';
@endphp

<div {{ $attributes->whereDoesntStartWith('wire:model') }} class="min-h-0 flex-1 overflow-y-auto">
    <div class="bg-white pt-5 pb-20 shadow min-h-full flex">
        <div class="flex-1 min-h-full px-3 sm:flex sm:justify-center sm:items-baseline sm:px-6 lg:px-8">
            <div class="min-h-full sm:w-0 sm:flex-1 relative" style="max-width: 65ch;">
                <div>
                    <div class="{{ $classes }} whitespace-pre-wrap px-3 py-2 text-red-500 break-words invisible" style="font-family: 'Writer'">{{ $post->markdown }}</div>
                    <textarea {{ $attributes->wire('model') }} class="{{ $classes }} absolute inset-0 bg-transparent border-0 resize-none focus:ring-0" style="font-family: 'Writer'" placeholder="Write here." autofocus></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
