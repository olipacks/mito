@props(['href' => null, 'color' => 'primary'])

@php
$hyperscript = $href ? 'a' : 'button';

switch ($color) {
    case 'transparent':
        $colorClasses = 'border-transparent text-gray-600 bg-white hover:bg-gray-50 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500';
        $shadow = false;
        break;
    case 'white':
        $colorClasses = 'border-gray-300 text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500';
        $shadow = true;
        break;
    case 'red':
        $colorClasses = 'border-transparent text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500';
        $shadow = true;
        break;
    case 'primary':
    default:
        $colorClasses = 'border-transparent text-white bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500';
        $shadow = true;
        break;
}
@endphp

<span class="inline-flex rounded {{ $shadow ? 'shadow-sm' : null}}">
    <{{ $hyperscript }} {{ $attributes->merge(['type' => $href ? null : 'submit', 'href' => $href, 'class' => "w-full inline-flex items-center justify-center px-3 py-2 border text-sm leading-4 font-medium rounded-md disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none transition ease-in-out duration-150 $colorClasses"]) }}>
        {{ $slot }}
    </{{ $hyperscript }}>
</span>
