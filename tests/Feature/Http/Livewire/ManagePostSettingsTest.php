<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Mito\Http\Livewire\ManagePostSettings;
use Mito\Models\Post;
use function Pest\Livewire\livewire;

beforeEach(function () {
    $this->post = Post::factory()->create();
});

it('can update post slug', function () {
    livewire(ManagePostSettings::class, ['post' => $this->post])
        ->set('slug', 'custom-slug')
        ->call('save', 'slug');

    expect($this->post->fresh()->slug)->toBe('custom-slug');
});

it('validates a required slug', function () {
    $response = livewire(ManagePostSettings::class, ['post' => $this->post])
        ->set('slug', '')
        ->call('save', 'slug');

    $response->assertHasErrors(['slug' => 'required']);
});

it('validates a unique', function () {
    $post = Post::factory()->create(['slug' => 'custom-slug']);

    $response = livewire(ManagePostSettings::class, ['post' => $this->post])
        ->set('slug', 'custom-slug')
        ->call('save', 'slug');

    $response->assertHasErrors(['slug' => 'unique']);
});

it('can store a feature image', function () {
    Storage::fake('public');

    $image = UploadedFile::fake()->image('image.png');

    $response = livewire(ManagePostSettings::class, ['post' => $this->post])
        ->set('image', $image)
        ->call('saveImage');

    expect($this->post->fresh()->feature_image_path)->not()->toBeEmpty();
});

it('validates uploaded file is an image', function () {
    Storage::fake('public');

    $file = UploadedFile::fake()->create('document.pdf');

    $response = livewire(ManagePostSettings::class, ['post' => $this->post])
        ->set('image', $file)
        ->assertHasErrors(['image' => 'image']);
});

it('validates uploaded file is no bigger than 10M', function () {
    Storage::fake('public');

    $image = UploadedFile::fake()->image('image.png')->size(10241);

    $response = livewire(ManagePostSettings::class, ['post' => $this->post])
        ->set('image', $image)
        ->call('saveImage')
        ->assertHasErrors(['image' => 'max']);
});
