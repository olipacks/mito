@php
$classes = 'text-sm w-full min-h-full overflow-hidden';
@endphp

<div {{ $attributes->whereDoesntStartWith('wire:model') }} class="min-h-0 flex-1 overflow-y-auto">
    <div class="bg-white pt-5 pb-20 shadow min-h-full flex">
        <div class="flex-1 min-h-full px-3 sm:flex sm:justify-center sm:items-baseline sm:px-6 lg:px-8 overflow-hidden">
            <div class="min-h-full sm:w-0 sm:flex-1 relative" style="max-width: 65ch;">
                <file-attachment
                    class="block"
                    x-on:file-attachment-accepted="
                        attachment = $event.detail?.attachments?.[0];

                        if (! attachment || ! attachment.file) return;

                        @this.upload('image', attachment.file);
                    "
                >
                    <div class="{{ $classes }} whitespace-pre-wrap px-3 py-2 text-red-500 break-words invisible" style="font-family: 'Writer'">{{ $post->markdown }}</div>
                    <textarea
                        {{ $attributes->wire('model') }}
                        x-on:keydown.meta.b.prevent="$refs.bold.click()"
                        x-on:keydown.meta.i.prevent="$refs.italic.click()"
                        x-on:keydown.meta.shift.period.prevent="$refs.quote.click()"
                        x-on:keydown.meta.k.prevent="$refs.link.click()"
                        class="{{ $classes }} absolute inset-0 bg-transparent border-0 resize-none focus:ring-0"
                        style="font-family: 'Writer'"
                        placeholder="Write here."
                        id="markdown"
                        autofocus
                    ></textarea>
                </file-attachment>
            </div>
        </div>
    </div>
</div>
