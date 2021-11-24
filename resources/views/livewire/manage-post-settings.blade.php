<x-mito::modal>
    <x-slot name="title">
        Manage post settings
    </x-slot>

    <x-slot name="content">
        <div class="space-y-5 sm:space-y-6 mt-5 sm:mt-6">
            <form wire:submit.prevent="saveImage">
                <x-mito::input.label value="Post Image" />

                @if ($image && ! $errors->has('image'))
                    <div class="mt-1">
                        <img class="object-cover h-36 w-full rounded-md" src="{{ $image->temporaryUrl() }}">
                    </div>
                @elseif ($post->feature_image_url)
                    <div class="mt-1">
                        <img class="object-cover h-36 w-full rounded-md" src="{{ $post->feature_image_url }}">
                    </div>
                @else
                    <file-attachment
                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md"
                        x-data
                        x-on:file-attachment-accepted="
                            attachment = $event.detail?.attachments?.[0];

                            if (! attachment || ! attachment.file) return;

                            @this.upload('image', attachment.file);
                        "
                        input="post-image-upload"
                        id="post-image-attachment"
                    >
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="post-image-upload" class="relative cursor-pointer bg-white rounded-md font-medium underline text-gray-600 hover:text-gray-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-gray-500">
                                    <span>Upload a file</span>
                                    <input wire:model="image" x-ref="postImageUpload" id="post-image-upload" type="file" class="sr-only">
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

                <div class="mt-2 flex justify-between items-center">
                    <div class="flex space-x-3 items-center">
                        <x-mito::button color="white">Save</x-mito::button>

                        <x-mito::input.saved for="image" />
                    </div>

                    @if ($image || $post->feature_image_url)
                        <label for="post-image-upload" class="relative cursor-pointer bg-white rounded-md text-sm font-medium underline text-gray-600 hover:text-gray-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-gray-500">
                            <span>Select A New Image</span>
                            <input wire:model="image" x-ref="postImageUpload" id="post-image-upload" type="file" class="sr-only">
                        </label>
                    @endif
                </div>
            </form>

            <form wire:submit.prevent="save({{ json_encode('slug') }})">
                <div class="flex justify-between">
                    <x-mito::input.label for="slug" value="Slug" />
                </div>

                <div class="flex mt-1">
                    <div class="flex-1">
                        <x-mito::input.text id="slug" type="text" class="block w-full" leading-add-on="{{ request()->getHost() }}/" wire:model="slug" />
                    </div>
                    <x-mito::button color="white" :disabled="$slug === $post->slug" class="ml-2">
                        Save
                    </x-mito::button>
                </div>

                <x-mito::input.saved for="slug" class="mt-2" />

                <x-mito::input.error for="slug" class="mt-2" />
            </form>

            <button type="button" wire:click="$emit('openModal', 'mito::posts.delete-post', {{ json_encode(['post' => $post->id]) }})" class="text-sm font-medium text-red-600">
                Delete post
            </button>
        </div>
    </x-slot>
</x-mito::modal>
