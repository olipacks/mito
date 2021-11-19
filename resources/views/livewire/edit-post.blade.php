<x-mito::post-layout>
    <x-slot name="centerColumn" x-data="">
        <x-mito::post-toolbar :post="$post" />

        <x-mito::post-editor wire:model="post.markdown" :post="$post" />

        <x-mito::post-editor-toolbar />
    </x-slot>

    <x-slot name="rightColumn">
        <x-mito::post-preview :post="$post" />
    </x-slot>

    <x-slot name="leftColumn">
        <x-mito::post-list :currentType="$type" :posts="$posts" :currentPost="$post" />
    </x-slot>
</x-mito::post-layout>
