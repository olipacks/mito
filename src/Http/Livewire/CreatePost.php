<?php

namespace Mito\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;
use Mito\Models\Post;

class CreatePost extends Component
{
    public Post $post;

    protected $rules = [
        'post.markdown' => 'sometimes',
    ];

    public function mount()
    {
        $this->post = new Post();
    }

    public function create()
    {
        $this->validate();

        $this->post->fill([
            'slug' => Str::slug($this->post->title),
        ])->save();

        return redirect()->to(route('mito.posts.index'));
    }

    public function render()
    {
        return view('mito::livewire.create-post')->layout('mito::layouts.html');
    }
}
