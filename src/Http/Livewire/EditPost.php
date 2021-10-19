<?php

namespace Mito\Http\Livewire;

use Livewire\Component;
use Mito\Models\Post;

class EditPost extends Component
{
    public Post $post;

    protected $rules = [
        'post.title' => 'required',
        'post.slug' => 'required',
        'post.markdown' => 'sometimes',
    ];

    public function render()
    {
        return view('mito::livewire.edit-post')->layout('mito::layouts.html');
    }

    public function save()
    {
        $this->validate();

        $this->post->save();

        return redirect()->to(route('mito.posts.index'));
    }
}
