<?php

use Mito\Http\Livewire\EditPost;
use Mito\Models\Post;

beforeEach(function () {
    $this->post = Post::factory()->create();
});

it('can update post', function () {
    $this->livewire(EditPost::class, ['post' => $this->post])
        ->set('post.markdown', '::markdown::');

    expect(Post::whereMarkdown('::markdown::')->exists())->toBeTrue();
});

it('can create draft', function () {
    $this->livewire(EditPost::class, ['post' => $this->post])
        ->call('createDraft');

    expect(Post::where('id', '!=', $this->post->id)->where('status', 'draft')->exists())->toBeTrue();
});

it('can create a second draft', function () {
    $firstDraft = Post::factory()->emptyDraft()->create();

    $this->livewire(EditPost::class, ['post' => $this->post])
        ->call('createDraft');

    expect(Post::where('id', '!=', $this->post->id)->where('status', 'draft')->count())->toBe(2);
});

it('redirects to edit draft page after creation', function () {
    $response = $this->livewire(EditPost::class, ['post' => $this->post])
        ->call('createDraft');

    $draftPost = Post::where('id', '!=', $this->post->id)->where('status', 'draft')->first();

    $response->assertRedirect(route('mito.posts.edit', $draftPost));
});
