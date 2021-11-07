<x-mito::modal>
    <x-slot name="title">
        Manage post settings
    </x-slot>

    <x-slot name="content">
        <div class="space-y-5 sm:space-y-6 mt-5 sm:mt-6">
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
