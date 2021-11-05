@props(['href' => null])

@php
$hyperscript = $href ? 'a' : 'button';
@endphp

<span class="inline-flex rounded">
    <{{ $hyperscript }} {{ $attributes->merge(['type' => $href ? null : 'submit', 'href' => $href, 'class' => "inline-flex items-center p-1.5 border text-sm leading-4 font-medium rounded-md disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none transition ease-in-out duration-150 border-transparent text-gray-600 bg-white hover:bg-gray-100 hover:border-gray-300 focus:border-purple-300 focus:shadow-outline-purple active:text-gray-800 active:bg-gray-50"]) }}>
        <span class="sr-only">{{ ('Settings') }}</span>
        <x-mito::icon.settings class="h-5 w-5" />
    </{{ $hyperscript }}>
</span>
