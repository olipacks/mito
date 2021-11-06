<?php

namespace Mito\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;
use Mito\Models\Post;

class EditPost extends Component
{
    use HasImages;
    use WithDraftCreation;

    public Post $post;
    public $type;
    public $image;

    protected $rules = [
        'post.markdown' => 'nullable|sometimes',
    ];

    public function mount(Post $post)
    {
        $this->type = $post->status;
    }

    public function updated($propertyName)
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

    public function updatedImage()
    {
        $imagePath = $this->storeImage($this->image);

        $imageUrl = $this->getImageUrl($imagePath);

        $this->post->markdown = Str::of($this->post->markdown)->append("![]({$imageUrl})");

        $this->post->save();

        $this->dispatchBrowserEvent('notify', 'Image added!');
    }

    public function save()
    {
        $this->validate();

        $this->post->save();

        $this->dispatchBrowserEvent('notify', 'Saved!');
    }

    public function publish()
    {
        if (is_null($this->post->slug)) {
            $this->post->fill([
                'slug' => Str::slug($this->post->title),
            ])->save();
        }

        $this->post->markAsPublished();

        $this->type = 'published';

        $this->dispatchBrowserEvent('notify', 'Published!');
    }

    public function unpublish()
    {
        $this->post->markAsDraft();

        $this->type = 'draft';

        $this->dispatchBrowserEvent('notify', 'Unpublished!');
    }

    public function render()
    {
        return view('mito::livewire.edit-post', [
            'posts' => Post::where('status', $this->type)->latest($this->type === 'published' ? 'published_at' : 'created_at')->get(),
        ])->layout('mito::layouts.html');
    }
}
