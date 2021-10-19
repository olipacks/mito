<div>
    <form wire:submit.prevent="save">
        <input wire:model="post.title" type="text">
        <input wire:model="post.slug" type="text">
        <textarea wire:model="post.markdown" cols="30" rows="10"></textarea>

        <button>Save Post</button>
    </form>
</div>
