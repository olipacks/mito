<?php

use Mito\Http\Livewire\ManagePostSettings;
use Mito\Models\Post;

beforeEach(function () {
    $this->post = Post::factory()->create();
});

it('can update post slug', function () {
    $this->livewire(ManagePostSettings::class, ['post' => $this->post])
        ->set('post.custom_slug', 'custom-slug')
        ->call('save', 'post.custom_slug');

    expect($this->post->fresh()->custom_slug)->toBe('custom-slug');
    expect($this->post->fresh()->slug)->toBe('custom-slug');
});

it('it validates a required slug', function () {
    $response = $this->livewire(ManagePostSettings::class, ['post' => $this->post])
        ->set('post.custom_slug', '')
        ->call('save', 'post.custom_slug');

    $response->assertHasErrors(['post.custom_slug' => 'required']);
});

it('it validates a unique', function () {
    $post = Post::factory()->create(['slug' => 'custom-slug']);

    $response = $this->livewire(ManagePostSettings::class, ['post' => $this->post])
        ->set('post.custom_slug', 'custom-slug')
        ->call('save', 'post.custom_slug');

    $response->assertHasErrors(['post.custom_slug' => 'unique']);
});
