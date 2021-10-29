<div x-data="{ focused: false }">
    <input @focus="focused = true" @blur="focused = false" class="sr-only" type="file" {{ $attributes }}>
    <label for="{{ $attributes['id'] }}" :class="{ 'outline-none ring-2 ring-offset-2 ring-purple-500': focused }" class="cursor-pointer inline-flex items-center p-1 border border-transparent rounded-full text-gray-700 bg-white hover:bg-gray-50">
        {{ $slot }}
    </label>
</div>
