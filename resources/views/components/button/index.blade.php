@props(['href' => null, 'color' => 'primary'])

@php
$hyperscript = $href ? 'a' : 'button';

switch ($color) {
    case 'transparent':
        $colorClasses = 'border-transparent text-gray-600 bg-white hover:bg-gray-50 hover:text-gray-700 hover:border-gray-300 focus:border-purple-300 focus:shadow-outline-purple active:text-gray-800 active:bg-gray-50';
        $shadow = false;
        break;
    case 'white':
        $colorClasses = 'border-gray-300 text-gray-700 bg-white hover:bg-gray-50 focus:border-purple-300 focus:shadow-outline-purple active:text-gray-800 active:bg-gray-50';
        $shadow = true;
        break;
    case 'red':
        $colorClasses = 'border-transparent text-white bg-red-600 hover:bg-red-500 focus:border-red-700 focus:shadow-outline-red active:bg-red-700';
        $shadow = true;
        break;
    case 'primary':
    default:
        $colorClasses = 'border-transparent text-white bg-purple-600 hover:bg-purple-500 focus:border-purple-700 focus:shadow-outline-purple active:bg-purple-700';
        $shadow = true;
        break;
}
@endphp

<span class="inline-flex rounded {{ $shadow ? 'shadow-sm' : null}}">
    <{{ $hyperscript }} {{ $attributes->merge(['type' => $href ? null : 'submit', 'href' => $href, 'class' => "w-full inline-flex items-center justify-center px-3 py-2 border text-sm leading-4 font-medium rounded-md disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none transition ease-in-out duration-150 $colorClasses"]) }}>
        {{ $slot }}
    </{{ $hyperscript }}>
</span>
