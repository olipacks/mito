@php
$classes = 'text-sm w-full min-h-full';
@endphp

<div {{ $attributes->whereDoesntStartWith('wire:model') }}>
    <div class="{{ $classes }} whitespace-pre-wrap px-3 py-2 text-red-500 break-words invisible" style="font-family: 'Writer'">{{ $post->markdown }}</div>
    <textarea {{ $attributes->wire('model') }} class="{{ $classes }} absolute inset-0 bg-transparent border-0 resize-none focus:ring-0" style="font-family: 'Writer'" placeholder="Write here." autofocus></textarea>
</div>
