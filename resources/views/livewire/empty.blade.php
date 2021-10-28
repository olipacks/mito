<x-mito::post-layout>
    <x-slot name="header">
        <x-mito::navbar :currentType="$type" />
    </x-slot>

    <x-slot name="centerColumn">
        <div class="bg-white pt-5 pb-6 shadow min-h-full flex">
            <div class="flex-1 min-h-full px-4 sm:flex sm:justify-center sm:items-baseline sm:px-6 lg:px-8">
                <div class="min-h-full sm:w-0 sm:flex-1 relative" style="max-width: 65ch;">
                    <div class="text-center">
                        <h3 class="mt-2 text-sm font-medium text-gray-900">
                            @if ($type === 'draft')
                                No drafts
                            @elseif ($type === 'published')
                                No published posts
                            @endif
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Get started by creating a new draft.
                        </p>
                        <div class="mt-6">
                            <form wire:submit.prevent="createDraft">
                                <x-mito::button color="primary">
                                    <x-mito::icon.plus class="-ml-1 mr-2 h-5 w-5" />
                                    New Draft
                                </x-mito::button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="rightColumn"></x-slot>

    <x-slot name="leftColumn"></x-slot>
</x-mito::post-layout>
