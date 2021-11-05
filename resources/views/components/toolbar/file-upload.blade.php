<div x-data="{ focused: false }">
    <input @focus="focused = true" @blur="focused = false" class="sr-only" type="file" {{ $attributes }}>
    <label for="{{ $attributes['id'] }}" :class="{ 'outline-none ring-2 ring-offset-2 ring-purple-500': focused }" class="cursor-pointer inline-flex items-center p-1.5 border border-transparent rounded-md text-gray-600 bg-white hover:bg-gray-100 hover:text-gray-700 hover:border-gray-300">
        {{ $slot }}
    </label>
</div>
