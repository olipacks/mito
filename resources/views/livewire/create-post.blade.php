<div>
    <form wire:submit.prevent="create">
        <input wire:model="title" type="text">
        <input wire:model="slug" type="text">
        <textarea wire:model="markdown" cols="30" rows="10"></textarea>

        <button>Create Post</button>
    </form>
</div>
