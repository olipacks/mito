<?php

use Mito\Http\Livewire\CreatePost;
use Mito\Models\Post;

it('can create post', function () {
    $this->livewire(CreatePost::class)
        ->set('title', '::title::')
        ->set('slug', 'slug')
        ->set('markdown', '::markdown::')
        ->call('create');

    expect(Post::whereTitle('::title::')->exists())->toBeTrue();
});

test('title is required', function () {
    $this->livewire(CreatePost::class)
        ->set('slug', 'slug')
        ->set('markdown', '::markdown::')
        ->call('create')
        ->assertHasErrors(['title' => 'required']);
});

test('slug is required', function () {
    $this->livewire(CreatePost::class)
        ->set('title', '::title::')
        ->set('markdown', '::markdown::')
        ->call('create')
        ->assertHasErrors(['slug' => 'required']);
});

it('is redirected to post page after creation', function () {
    $this->livewire(CreatePost::class)
        ->set('title', '::title::')
        ->set('slug', 'title')
        ->set('markdown', '::markdown::')
        ->call('create')
        ->assertRedirect(route('mito.posts.index'));
});
