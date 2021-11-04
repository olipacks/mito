<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mito\Http\Livewire\EditPost;
use Mito\Models\Post;

beforeEach(function () {
    $this->draft = Post::factory()->draft()->create();
});

it('autosaves a draft when the markdown is updated.', function () {
    $this->livewire(EditPost::class, ['post' => $this->draft])
        ->set('post.markdown', '::markdown::');

    expect(Post::whereMarkdown('::markdown::')->exists())->toBeTrue();
});

it('can create draft', function () {
    $this->livewire(EditPost::class, ['post' => $this->draft])
        ->call('createDraft');

    expect(Post::where('id', '!=', $this->draft->id)->where('status', 'draft')->exists())->toBeTrue();
});

it('can create a second draft', function () {
    $firstDraft = Post::factory()->emptyDraft()->create();

    $this->livewire(EditPost::class, ['post' => $this->draft])
        ->call('createDraft');

    expect(Post::where('id', '!=', $this->draft->id)->where('status', 'draft')->count())->toBe(2);
});

it('redirects to edit draft page after creation', function () {
    $response = $this->livewire(EditPost::class, ['post' => $this->draft])
        ->call('createDraft');

    $draftPost = Post::where('id', '!=', $this->draft->id)->where('status', 'draft')->first();

    $response->assertRedirect(route('mito.posts.edit', $draftPost));
});

it('can store an image', function () {
    Storage::fake('public');

    $image = UploadedFile::fake()->image('image.png');

    $this->livewire(EditPost::class, ['post' => $this->draft])
        ->set('image', $image);

    $uploadedFilePath = Str::of($this->draft->fresh()->markdown)
        ->after('![]')
        ->between('(', ')')
        ->after('/storage/');

    Storage::disk('public')->assertExists($uploadedFilePath);
});

it('can add markdown image syntax on image upload', function () {
    Storage::fake('public');

    $image = UploadedFile::fake()->image('image.png');

    $this->livewire(EditPost::class, ['post' => $this->draft])
        ->set('image', $image);

    expect(Str::of($this->draft->fresh()->markdown)->contains('![]'))
        ->toBeTrue();
});

it('can dispatch notify event on image upload', function () {
    Storage::fake('public');

    $image = UploadedFile::fake()->image('image.png');

    $this->livewire(EditPost::class, ['post' => $this->draft])
        ->set('image', $image)
        ->assertDispatchedBrowserEvent('notify');
});
