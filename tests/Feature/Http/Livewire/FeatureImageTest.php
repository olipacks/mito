<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Mito\Http\Livewire\FeatureImage;
use function Pest\Livewire\livewire;

it('can upload a feature image', function () {
    Storage::fake('public');

    $image = UploadedFile::fake()->image('image.png');

    livewire(FeatureImage::class)
        ->set('image', $image)
        ->call('save');

    expect(Storage::disk('public')->allFiles())->not()->toBeEmpty();
});

it('validates uploaded file is an image', function () {
    Storage::fake('public');

    $file = UploadedFile::fake()->create('document.pdf');

    livewire(FeatureImage::class)
        ->set('image', $file)
        ->assertHasErrors(['image' => 'image']);
});

it('validates uploaded file is no bigger than 10M', function () {
    Storage::fake('public');

    $image = UploadedFile::fake()->image('image.png')->size(10241);

    livewire(FeatureImage::class)
        ->set('image', $image)
        ->call('save')
        ->assertHasErrors(['image' => 'max']);
});
