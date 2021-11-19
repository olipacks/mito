<div class="flex-shrink-0 bg-white">
    <div class="h-14 px-3 flex justify-center">
        <div class="flex justify-between items-center w-full" style="max-width: 65ch;">
            <div>
                <x-mito::toolbar.file-upload wire:model="image" id="image-upload">
                    <x-mito::icon.image class="h-5 w-5" />
                </x-mito::toolbar.file-upload>
            </div>
            <div>
                <x-mito::toolbar.markdown />

                <div>
                    <x-mito::offline-notification wire:offline.class.remove="hidden" class="hidden" />
                </div>
            </div>
        </div>
    </div>
</div>
