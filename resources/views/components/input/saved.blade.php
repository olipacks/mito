@props(['for'])

<p
    x-data="{ open: false }"
    x-init="
        $wire.on('notify-saved', (propertyName) => {
            if (propertyName !== '{{ $for }}') {
                return;
            }

            if (open === false) setTimeout(() => { open = false }, 2500);

            open = true;
        })
    "
    x-show.transition.out.duration.1000ms="open"
    style="display: none;"
    {{ $attributes->merge(['class' => 'text-sm text-gray-500']) }}>
    Saved.
</p>
