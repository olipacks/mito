<?php

use Mito\Http\Livewire\UpdatePostStatusModal;
use Mito\Models\Post;
use function Pest\Livewire\livewire;

beforeEach(function () {
    $this->draft = Post::factory()->draft()->create();
});

it('can schedule post', function () {
    livewire(UpdatePostStatusModal::class, ['post' => $this->draft])
        ->set('date', '2030-12-11')
        ->set('time', '10:09')
        ->call('schedule');

    expect($this->draft->fresh()->isScheduled())->toBeTrue();
    expect($this->draft->fresh()->published_at->isFuture())->toBeTrue();
});

it('validates a required publish date-time on schedule post', function () {
    $response = livewire(UpdatePostStatusModal::class, ['post' => $this->draft])
        ->set('date', '')
        ->set('time', '')
        ->call('schedule');

    $response->assertHasErrors(['publishDateTime' => 'required']);
});

it('validates publish date-time', function () {
    $response = livewire(UpdatePostStatusModal::class, ['post' => $this->draft])
        ->set('date', 'invalid-date')
        ->set('time', 'invalid-hour')
        ->call('schedule');

    $response->assertHasErrors(['publishDateTime' => 'date_format']);
});
