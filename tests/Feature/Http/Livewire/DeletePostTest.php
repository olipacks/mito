<?php

use Olipacks\Mito\Http\Livewire\DeletePost;
use Olipacks\Mito\Models\Post;

it('can delete a post', function () {
    $post = Post::factory()->create();

    $this->livewire(DeletePost::class, ['post' => $post])
        ->call('delete');

    $this->assertDeleted($post);
});

it('redirects to show posts after deletion', function () {
    $post = Post::factory()->create();

    $response = $this->livewire(DeletePost::class, ['post' => $post])
        ->call('delete');

    $response->assertRedirect(route('mito.posts.index', ['type' => $post->status]));
});
