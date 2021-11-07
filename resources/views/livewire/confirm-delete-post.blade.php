<x-mito::modal>
    <x-slot name="title">
        Delete post
    </x-slot>

    <x-slot name="content">
        <div class="mt-2">
            <p class="text-sm text-gray-500">
                Are you sure you want to delete this post? This action cannot be undone.
            </p>
        </div>
        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
            <div class="sm:ml-3 sm:w-auto w-full flex flex-col">
                <x-mito::button wire:click.prevent="delete" type="button" color="red">
                      Delete
                </x-mito::button>
            </div>

            <div class="mt-3 sm:mt-0 sm:w-auto w-full flex flex-col">
                <x-mito::button wire:click="$emit('closeModal')" type="button" color="white">
                      Cancel
                </x-mito::button>
            </div>
        </div>
    </x-slot>
</x-mito::modal>
