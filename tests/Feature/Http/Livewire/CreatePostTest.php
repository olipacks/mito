<?php

use Mito\Http\Livewire\CreatePost;
use Mito\Models\Post;

it('can create post', function () {
    $this->livewire(CreatePost::class)
        ->set('post.markdown', '::markdown::')
        ->call('create');

    expect(Post::whereMarkdown('::markdown::')->exists())->toBeTrue();
});

it('can create a post with an untitled slug if markdown is empty', function () {
    $this->livewire(CreatePost::class)
        ->set('post.markdown', '')
        ->call('create');

    expect(Post::whereSlug('untitled')->exists())->toBeTrue();
});

it('can create a post with an untitled-2 slug if markdown is empty and another post with empty markdown exists', function () {
    $post = Post::factory()->create([
        'markdown' => '',
        'slug' => '',
    ]);

    $this->livewire(CreatePost::class)
        ->set('post.markdown', '')
        ->call('create');

    expect(Post::whereSlug('untitled-2')->exists())->toBeTrue();
});

it('can create a post with a sequential slug if the title slug is duplicated', function () {
    $post = Post::factory()->create([
        'slug' => 'slug',
    ]);

    $this->livewire(CreatePost::class)
        ->set('post.markdown', '# slug')
        ->call('create');

    expect(Post::whereSlug('slug-2')->exists())->toBeTrue();
});

it('is redirected to post page after creation', function () {
    $this->livewire(CreatePost::class)
        ->set('post.markdown', '::markdown::')
        ->call('create')
        ->assertRedirect(route('mito.posts.index'));
});
