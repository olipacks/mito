<?php

use Mito\Http\Livewire\UpdatePostStatusModal;
use Mito\Models\Post;
use function Pest\Livewire\livewire;

beforeEach(function () {
    $this->draft = Post::factory()->draft()->create();
});

it('can publish a draft modal', function () {
    $this->livewire(UpdatePostStatusModal::class, ['post' => $this->draft])
        ->set('status', 'published')
        ->call('update');

    expect($this->draft->fresh()->isPublished())->toBeTrue();
});

it('can unpublish a published post', function () {
    $publishedPost = tap($this->draft)->markAsPublished();

    $this->livewire(UpdatePostStatusModal::class, ['post' => $publishedPost])
        ->set('status', 'draft')
        ->call('update');

    expect($publishedPost->fresh()->isDraft())->toBeTrue();
});

it('can schedule post', function () {
    livewire(UpdatePostStatusModal::class, ['post' => $this->draft])
        ->set('status', 'scheduled')
        ->set('date', '2030-12-11')
        ->set('time', '10:09')
        ->call('update');

    expect($this->draft->fresh()->isScheduled())->toBeTrue();
    expect($this->draft->fresh()->published_at->isFuture())->toBeTrue();
});


it('generates a slug on publish a draft with no custom slug', function () {
    $this->livewire(UpdatePostStatusModal::class, ['post' => $this->draft])
        ->set('status', 'published')
        ->call('update');

    expect($this->draft->slug)->toBeNull();
    expect($this->draft->fresh()->slug)->not()->toBeNull();
});

it('does not generate a slug on publish a draft with custom slug', function () {
    $this->draft->fill([
        'slug' => 'custom-slug',
    ])->save();

    $this->livewire(UpdatePostStatusModal::class, ['post' => $this->draft])
        ->set('status', 'published')
        ->call('update');

    expect($this->draft->fresh()->slug)->toBe('custom-slug');
});

it('validates a required publish date-time on schedule post', function () {
    $response = livewire(UpdatePostStatusModal::class, ['post' => $this->draft])
        ->set('status', 'scheduled')
        ->set('date', '')
        ->set('time', '')
        ->call('update');

    $response->assertHasErrors(['publishDateTime' => 'required']);
});

it('validates publish date-time', function () {
    $response = livewire(UpdatePostStatusModal::class, ['post' => $this->draft])
        ->set('status', 'scheduled')
        ->set('date', 'invalid-date')
        ->set('time', 'invalid-hour')
        ->call('update');

    $response->assertHasErrors(['publishDateTime' => 'date_format']);
});
