<x-mito::modal>
    <x-slot name="title">
        Update post status
    </x-slot>

    <x-slot name="content">
        <form wire:submit.prevent="update">
            <fieldset>
                <legend class="sr-only">Status</legend>
                <div class="space-y-5">
                    <div class="relative flex items-start">
                        <div class="flex items-center h-5">
                            <input id="unpublished" wire:model="status" value="draft" type="radio" class="focus:ring-gray-500 h-4 w-4 text-gray-600 border-gray-300">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="unpublished" class="font-medium text-gray-700">Unpublished</label>
                            <p class="text-gray-500">Private draft</p>
                        </div>
                    </div>

                    <div class="relative flex items-start">
                        <div class="flex items-center h-5">
                            <input id="published" wire:model="status" value="published" type="radio" class="focus:ring-gray-500 h-4 w-4 text-gray-600 border-gray-300">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="published" class="font-medium text-gray-700">Published</label>
                            <p class="text-gray-500">Displayed publicly</p>
                        </div>
                    </div>

                    <div class="relative flex items-start">
                        <div class="flex items-center h-5">
                            <input id="scheduled" wire:model="status" value="scheduled" type="radio" class="focus:ring-gray-500 h-4 w-4 text-gray-600 border-gray-300">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="scheduled" class="font-medium text-gray-700">Scheduled</label>

                            <div>
                                <div class="flex space-x-2">
                                    <div>
                                        <x-mito::input.label class="sr-only" for="date" value="Date" />
                                        <x-mito::input.text wire:model="date" id="date" type="text" class="mt-1 block w-full" placeholder="YYYY-MM-DD" />
                                    </div>
                                    <div>
                                        <x-mito::input.label class="sr-only" for="time" value="Time" />
                                        <x-mito::input.text wire:model="time" id="time" type="text" class="mt-1 block w-full" placeholder="HH:MM" />
                                    </div>
                                </div>

                                <x-mito::input.error for="publishDateTime" class="mt-2" />
                            </div>

                            <p class="mt-1 text-gray-500">Set to publish later</p>
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <div class="sm:ml-3 sm:w-auto w-full flex flex-col">
                    <x-mito::button type="submit" color="primary">
                          Update
                    </x-mito::button>
                </div>

                <div class="mt-3 sm:mt-0 sm:w-auto w-full flex flex-col">
                    <x-mito::button wire:click="$emit('closeModal')" type="button" color="white">
                          Cancel
                    </x-mito::button>
                </div>
            </div>
        </form>
    </x-slot>
</x-mito::modal>
