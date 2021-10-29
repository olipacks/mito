<div class="flex-shrink-0 bg-white">
    <div class="h-16 flex flex-col justify-center">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="py-3 flex justify-end">
                <x-mito::toolbar.file-upload wire:model="image" id="image-upload">
                    <x-mito::icon.image class="h-5 w-5" />
                </x-mito::toolbar.file-upload>
                <div>
                    <x-mito::offline-notification wire:offline.class.remove="hidden" class="hidden" />
                </div>
            </div>
        </div>
    </div>
</div>
