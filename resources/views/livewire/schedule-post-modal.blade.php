<x-mito::modal>
    <x-slot name="title">
        Schedule post
    </x-slot>

    <x-slot name="content">
        <div>
            <div class="flex space-x-2">
                <div>
                    <x-mito::input.label for="day" value="Day" />
                    <x-mito::input.text wire:model="day" id="day" type="text" class="mt-1 block w-full" maxlength="2" placeholder="DD" />
                    <x-mito::input.error for="day" class="mt-2" />
                </div>
                <div>
                    <x-mito::input.label for="month" value="Month" />
                    <x-mito::input.text wire:model="month" id="month" type="text" class="mt-1 block w-full" maxlength="2" placeholder="MM" />
                    <x-mito::input.error for="month" class="mt-2" />
                </div>
                <div>
                    <x-mito::input.label for="year" value="Year" />
                    <x-mito::input.text wire:model="year" id="year" type="text" class="mt-1 block w-full" maxlength="4" placeholder="YYYY" />
                    <x-mito::input.error for="year" class="mt-2" />
                </div>
                <div>
                    <x-mito::input.label for="hour" value="Hour" />
                    <x-mito::input.text wire:model="hour" id="hour" type="text" class="mt-1 block w-full" maxlength="2" placeholder="HH" />
                    <x-mito::input.error for="hour" class="mt-2" />
                </div>
                <div>
                    <x-mito::input.label for="minute" value="Minute" />
                    <x-mito::input.text wire:model="minute" id="minute" type="text" class="mt-1 block w-full" maxlength="2" placeholder="MM" />
                    <x-mito::input.error for="minute" class="mt-2" />
                </div>
            </div>

            <x-mito::input.error for="publishDate" class="mt-2" />
        </div>

        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
            <div class="sm:ml-3 sm:w-auto w-full flex flex-col">
                <x-mito::button wire:click.prevent="schedule" type="button" color="primary">
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
