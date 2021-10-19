<?php

use Mito\Models\Post;

it('can show posts', function () {
    $post = Post::factory()->create();

    $response = $this->get('mito/posts');

    $response
        ->assertStatus(200)
        ->assertSee($post->title);
});
