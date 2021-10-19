<div class="p-5">
    <form class="space-y-5" wire:submit.prevent="create">
        <input class="block" wire:model="title" type="text">
        <input class="block" wire:model="slug" type="text">
        <textarea class="block" wire:model="markdown" cols="30" rows="10"></textarea>

        <button class="block border p-2">Create Post</button>
    </form>
</div>
