<?php

use Mito\Http\Livewire\SchedulePostModal;
use Mito\Models\Post;

beforeEach(function () {
    $this->draft = Post::factory()->draft()->create();
});

it('can schedule post', function () {
    $this->livewire(SchedulePostModal::class, ['post' => $this->draft])
        ->set('date', '2030-12-11')
        ->set('time', '10:09')
        ->call('schedule');

    expect($this->draft->fresh()->isScheduled())->toBeTrue();
    expect($this->draft->fresh()->published_at->isFuture())->toBeTrue();
});

it('validates a required date', function () {
});

it('validates date', function () {
});
