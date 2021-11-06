<?php

use Mito\Http\Livewire\ManagePostSettings;
use Mito\Models\Post;

beforeEach(function () {
    $this->post = Post::factory()->create();
});

it('can update post slug', function () {
    $this->livewire(ManagePostSettings::class, ['post' => $this->post])
        ->set('slug', 'custom-slug')
        ->call('save', 'slug');

    expect($this->post->fresh()->slug)->toBe('custom-slug');
});

it('validates a required slug', function () {
    $response = $this->livewire(ManagePostSettings::class, ['post' => $this->post])
        ->set('slug', '')
        ->call('save', 'slug');

    $response->assertHasErrors(['slug' => 'required']);
});

it('validates a unique', function () {
    $post = Post::factory()->create(['slug' => 'custom-slug']);

    $response = $this->livewire(ManagePostSettings::class, ['post' => $this->post])
        ->set('slug', 'custom-slug')
        ->call('save', 'slug');

    $response->assertHasErrors(['slug' => 'unique']);
});
