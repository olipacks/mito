<?php

namespace Mito\Http\Livewire;

use Livewire\Component;
use Mito\Models\Post;

class ShowPosts extends Component
{
    public function render()
    {
        return view('mito::livewire.show-posts', [
            'posts' => Post::all(),
        ])->layout('mito::layouts.html');
    }
}
