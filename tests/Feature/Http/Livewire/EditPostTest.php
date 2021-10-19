<?php

use Mito\Http\Livewire\EditPost;
use Mito\Models\Post;

beforeEach(function () {
    $this->post = Post::factory()->create([
        'slug' => 'slug',
    ]);
});

it('can update post', function () {
    $this->livewire(EditPost::class, ['post' => $this->post])
        ->set('post.markdown', '::markdown::')
        ->call('save');

    expect(Post::whereMarkdown('::markdown::')->exists())->toBeTrue();
});

it('can update a post with an untitled slug if markdown is empty', function () {
    $this->livewire(EditPost::class, ['post' => $this->post])
        ->set('post.markdown', '')
        ->call('save');

    expect(Post::whereSlug('untitled')->exists())->toBeTrue();
});

it('is redirected to post page after creation', function () {
    $this->livewire(EditPost::class, ['post' => $this->post])
        ->set('post.markdown', '::markdown::')
        ->call('save')
        ->assertRedirect(route('mito.posts.index'));
});
