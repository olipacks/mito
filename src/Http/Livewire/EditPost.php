<?php

namespace Mito\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;
use Mito\Models\Post;

class EditPost extends Component
{
    public Post $post;

    protected $rules = [
        'post.markdown' => 'nullable|sometimes',
    ];

    public function save()
    {
        $this->validate();

        $this->post->fill([
            'slug' => Str::slug($this->post->title),
        ]);

        $this->post->save();

        return redirect()->to(route('mito.posts.index'));
    }

    public function render()
    {
        return view('mito::livewire.edit-post')->layout('mito::layouts.html');
    }
}
