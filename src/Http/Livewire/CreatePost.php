<?php

namespace Mito\Http\Livewire;

use Livewire\Component;
use Mito\Models\Post;

class CreatePost extends Component
{
    public $title;
    public $slug;
    public $markdown;

    protected $rules = [
        'title' => 'required',
        'slug' => 'required',
        'markdown' => 'sometimes',
    ];

    public function render()
    {
        return view('mito::livewire.create-post')->layout('mito::layouts.html');
    }

    public function create()
    {
        Post::create(
            $this->validate()
        );

        return redirect()->to(route('mito.posts.index'));
    }
}
