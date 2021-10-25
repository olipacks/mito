<?php

use Mito\Http\Livewire\ShowPosts;
use Mito\Models\Post;

it('can redirect to edit latest draft', function () {
    $draft = Post::factory()->draft()->create();

    $this->livewire(ShowPosts::class)
        ->assertRedirect(route('mito.posts.edit', $draft));
});

it('can render empty drafts component if there are no drafts', function () {
    $this->livewire(ShowPosts::class)
        ->assertViewIs('mito::livewire.empty');
});
