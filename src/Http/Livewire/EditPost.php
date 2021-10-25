<?php

namespace Mito\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;
use Mito\Models\Post;

class EditPost extends Component
{
    public Post $post;
    public $type;

    protected $rules = [
        'post.markdown' => 'nullable|sometimes',
    ];

    public function mount(Post $post)
    {
        $this->type = $post->status;
    }

    public function updated($propertyName)
    {
        if ($propertyName !== 'post.markdown') {
            return;
        }

        $this->validate();

        $this->post->save();
    }

    public function publish()
    {
        $this->post->fill([
            'slug' => Str::slug($this->post->title),
        ])->save();

        $this->post->markAsPublished();

        $this->type = 'published';
    }

    public function createDraft()
    {
        $draft = Post::create();

        return redirect()->to(route('mito.posts.edit', $draft));
    }

    public function render()
    {
        return view('mito::livewire.edit-post', [
            'posts' => Post::where('status', $this->type)->latest($this->type === 'published' ? 'published_at' : 'created_at')->get(),
        ])->layout('mito::layouts.html');
    }
}
