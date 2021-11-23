<div class="max-w-xl mx-auto py-6">
    <form wire:submit.prevent="save">
        <div class="space-y-2">
            <div>
                <x-mito::input.label value="Feature Image" />
                @if ($image && ! $errors->has('image'))
                    <div class="mt-1">
                        <img class="object-cover h-36 w-full rounded-md" src="{{ $image->temporaryUrl() }}">
                    </div>
                @else
                    <file-attachment
                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md"
                        x-data
                        x-on:file-attachment-accepted.window="
                            attachment = $event.detail?.attachments?.[0];

                            if (! attachment || ! attachment.file) return;

                            @this.upload('image', attachment.file);
                        "
                    >
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="image-upload" class="relative cursor-pointer bg-white rounded-md font-medium underline text-gray-600 hover:text-gray-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-gray-500">
                                    <span>Upload a file</span>
                                    <input wire:model="image" id="image-upload" type="file" class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">
                                PNG, JPG, GIF up to 10MB
                            </p>
                        </div>
                    </file-attachment>

                    <x-mito::input.error for="image" class="mt-2" />
                @endif
                <x-mito::button color="white" class="mt-2">
                    Save
                </x-mito::button>
            </div>
        </div>
    </form>
</div>
