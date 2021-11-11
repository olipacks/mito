<?php

use Mito\Http\Livewire\SchedulePostModal;
use Mito\Models\Post;

beforeEach(function () {
    $this->draft = Post::factory()->draft()->create();
});

it('can schedule post', function () {
    $this->livewire(SchedulePostModal::class, ['post' => $this->draft])
        ->set('year', '2030')
        ->set('month', '12')
        ->set('day', '11')
        ->set('hour', '10')
        ->set('minute', '09')
        ->call('schedule');

    expect($this->draft->fresh()->isScheduled())->toBeTrue();
    expect($this->draft->fresh()->published_at->isFuture())->toBeTrue();
});

it('validates a required date', function () {

});

it('validates date', function () {

});
