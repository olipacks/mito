<x-mito::modal>
    <x-slot name="title">
        Manage post settings
    </x-slot>

    <x-slot name="content">
        <form wire:submit.prevent="save({{ json_encode('post.custom_slug') }})" class="mt-5 sm:mt-6">
            <x-mito::input.label for="slug" value="Slug" />

            <div class="flex mt-1">
                <div class="flex-1">
                    <x-mito::input.text id="slug" type="text" class="block w-full" leading-add-on="{{ request()->getHost() }}/" wire:model="post.custom_slug" />
                </div>
                <x-mito::button color="white" :disabled="! $post->isDirty('custom_slug')" class="ml-2">
                    Save
                </x-mito::button>
            </div>

            <x-mito::input.error for="post.custom_slug" class="mt-2" />
        </form>
    </x-slot>
</x-mito::modal>
