<?php

use Mito\Http\Livewire\ShowPosts;
use Mito\Models\Post;

it('can show all drafts', function () {
    $drafts = Post::factory()->draft()->count(3)->create();

    $response = $this->livewire(ShowPosts::class);

    $drafts->each->each(fn ($draft) => $response->assertSee($draft->title));
});

it('can filter by published posts', function () {
    $publishedPost = Post::factory()->published()->create();
    $draft = Post::factory()->draft()->create();

    $response = $this->livewire(ShowPosts::class, ['type' => 'published']);

    $response->assertSee($publishedPost->title);
    $response->assertDontSee($draft->title);
});

it('can filter by drafts', function () {
    $draft = Post::factory()->draft()->create();
    $publishedPost = Post::factory()->published()->create();

    $response = $this->livewire(ShowPosts::class, ['type' => 'draft']);

    $response->assertSee($draft->title);
    $response->assertDontSee($publishedPost->title);
});

it('can create a new draft', function () {
    $this->livewire(ShowPosts::class)
        ->call('createDraft');

    expect(Post::where('status', 'draft')->exists())->toBeTrue();
});
