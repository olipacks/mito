<div class="p-5">
    <form class="space-y-5" wire:submit.prevent="create">
        <textarea class="block" wire:model="post.markdown" cols="30" rows="10"></textarea>

        <button class="block border p-2">Create Post</button>
    </form>
</div>
