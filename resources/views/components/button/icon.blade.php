@props(['href' => null, 'color' => 'transparent'])

@php
$hyperscript = $href ? 'a' : 'button';

switch ($color) {
    case 'transparent':
    default:
        $colorClasses = 'border-transparent text-gray-600 bg-white hover:bg-gray-100 hover:text-gray-700 focus:border-purple-300 focus:shadow-outline-purple active:text-gray-800 active:bg-gray-50';
        $shadow = false;
        break;
}
@endphp

<span class="inline-flex rounded {{ $shadow ? 'shadow-sm' : null}}">
    <{{ $hyperscript }} {{ $attributes->merge(['type' => $href ? null : 'submit', 'href' => $href, 'class' => "w-full inline-flex items-center justify-center p-2 border text-sm leading-4 font-medium rounded-md disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none transition ease-in-out duration-150 $colorClasses"]) }}>
        {{ $slot }}
    </{{ $hyperscript }}>
</span>
