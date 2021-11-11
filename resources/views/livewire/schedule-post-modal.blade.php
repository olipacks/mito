<x-mito::modal>
    <x-slot name="title">
        Update post status
    </x-slot>

    <x-slot name="content">
        <fieldset>
          <legend class="sr-only">Status</legend>
          <div class="space-y-5">
            <div class="relative flex items-start">
              <div class="flex items-center h-5">
                <input id="small" aria-describedby="small-description" name="plan" type="radio" checked class="focus:ring-gray-500 h-4 w-4 text-gray-600 border-gray-300">
              </div>
              <div class="ml-3 text-sm">
                <label for="small" class="font-medium text-gray-700">Unpublished</label>
                <p id="small-description" class="text-gray-500">Private draft</p>
              </div>
            </div>

            <div class="relative flex items-start">
              <div class="flex items-center h-5">
                <input id="medium" aria-describedby="medium-description" name="plan" type="radio" class="focus:ring-gray-500 h-4 w-4 text-gray-600 border-gray-300">
              </div>
              <div class="ml-3 text-sm">
                <label for="medium" class="font-medium text-gray-700">Published</label>
                <p id="medium-description" class="text-gray-500">Displayed publicly</p>
              </div>
            </div>

            <div class="relative flex items-start">
              <div class="flex items-center h-5">
                <input id="large" aria-describedby="large-description" name="plan" type="radio" class="focus:ring-gray-500 h-4 w-4 text-gray-600 border-gray-300">
              </div>
              <div class="ml-3 text-sm">
                <label for="large" class="font-medium text-gray-700">Scheduled</label>
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
                <p id="large-description" class="mt-1 text-gray-500">Set to publish later</p>
              </div>
            </div>
          </div>
        </fieldset>



        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
            <div class="sm:ml-3 sm:w-auto w-full flex flex-col">
                <x-mito::button wire:click.prevent="schedule" type="button" color="primary">
                      Update
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
