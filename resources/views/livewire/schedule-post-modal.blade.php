<x-mito::modal>
    <x-slot name="title">
        Schedule post
    </x-slot>

    <x-slot name="content">
        <div>
            <div class="flex space-x-2">
                <div>
                    <x-mito::input.label for="date" value="Date" />
                    <x-mito::input.text wire:model="date" id="date" type="text" class="mt-1 block w-full" placeholder="YYYY-MM-DD" />
                    <x-mito::input.error for="date" class="mt-2" />
                </div>
                <div>
                    <x-mito::input.label for="time" value="Time" />
                    <x-mito::input.text wire:model="time" id="time" type="text" class="mt-1 block w-full" placeholder="HH:MM" />
                </div>
            </div>

            <x-mito::input.error for="publishDateTime" class="mt-2" />
        </div>

        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
            <div class="sm:ml-3 sm:w-auto w-full flex flex-col">
                <x-mito::button wire:click.prevent="schedule" type="button" color="green">
                      Schedule
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
