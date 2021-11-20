<?php

namespace Mito\Http\Livewire;

use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;
use Mito\Models\Post;

class EditPost extends Component
{
    use HasImages;
    use WithDraftCreation;

    public Post $post;
    public string $type;

    /** @var \Illuminate\Http\UploadedFile */
    public $image;

    /** @var array */
    protected $listeners = [
        'typeUpdated',
    ];

    protected array $rules = [
        'post.markdown' => 'nullable|sometimes',
    ];

    public function mount(Post $post): void
    {
        $this->type = $post->status;
    }

    public function updated(string $propertyName): void
    {
        if ($this->post->isPublished()) {
            return;
        }

        if ($propertyName !== 'post.markdown') {
            return;
        }

        $this->validate();

        $this->post->save();
    }

    public function updatedImage(): void
    {
        $imagePath = $this->storeImage($this->image);

        if ($imagePath === false) {
            return;
        }

        $imageUrl = $this->getImageUrl($imagePath);

        $this->post->markdown = Str::of($this->post->markdown ?? '')->append("![]({$imageUrl})");

        $this->post->save();

        $this->dispatchBrowserEvent('notify', 'Image added!');
    }

    public function save(): void
    {
        $this->validate();

        $this->post->save();

        $this->dispatchBrowserEvent('notify', 'Saved!');
    }

    public function typeUpdated(string $type): void
    {
        $this->type = $type;
    }

    public function render(): View
    {
        return view('mito::livewire.edit-post', [
            'posts' => Post::where('status', $this->type)->latest($this->type === 'published' ? 'published_at' : 'created_at')->get(),
        ])->layout('mito::layouts.html');
    }
}
