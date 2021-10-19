<?php

use Mito\Http\Livewire\EditPost;
use Mito\Models\Post;

beforeEach(function () {
    $this->post = Post::factory()->create();
});

it('can update post', function () {
    $this->livewire(EditPost::class, ['post' => $this->post])
        ->set('post.title', '::title::')
        ->set('post.slug', 'slug')
        ->set('post.markdown', '::markdown::')
        ->call('save');

    expect(Post::whereTitle('::title::')->exists())->toBeTrue();
});

test('title is required', function () {
    $this->livewire(EditPost::class, ['post' => $this->post])
        ->set('post.title', '')
        ->set('post.slug', 'slug')
        ->set('post.markdown', '::markdown::')
        ->call('save')
        ->assertHasErrors(['post.title' => 'required']);
});

test('slug is required', function () {
    $this->livewire(EditPost::class, ['post' => $this->post])
        ->set('post.title', '::title::')
        ->set('post.slug', '')
        ->set('post.markdown', '::markdown::')
        ->call('save')
        ->assertHasErrors(['post.slug' => 'required']);
});

it('is redirected to post page after creation', function () {
    $this->livewire(EditPost::class, ['post' => $this->post])
        ->set('post.title', '::title::')
        ->set('post.slug', 'title')
        ->set('post.markdown', '::markdown::')
        ->call('save')
        ->assertRedirect(route('mito.posts.index'));
});
