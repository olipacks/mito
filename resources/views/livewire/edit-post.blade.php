<x-mito::post-layout>
    <x-slot name="header">
        <x-mito::navbar :currentType="$type" />
    </x-slot>

    <x-slot name="centerColumn">
        <x-mito::post-toolbar />

        <x-mito::post-editor wire:model="post.markdown" :post="$post" />
    </x-slot>

    <x-slot name="rightColumn">
        <x-mito::post-preview :post="$post" />
    </x-slot>

    <x-slot name="leftColumn">
        <x-mito::post-list :type="$type" :posts="$posts" />
    </x-slot>
</x-mito::post-layout>
