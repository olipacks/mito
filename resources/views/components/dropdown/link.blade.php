@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block px-3.5 py-1.5 text-sm font-medium leading-5 text-gray-700 bg-gray-100 focus:outline-none focus:bg-gray-100 transition'
            : 'block px-3.5 py-1.5 text-sm font-medium leading-5 text-gray-600 hover:text-gray-700 hover:bg-gray-50 focus:outline-none focus:bg-gray-100 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
