<?php

namespace Mito\Http\Livewire;

use Livewire\Component;
use Mito\Models\Post;

class ShowPosts extends Component
{
    use WithDraftCreation;

    public $type = 'draft';

    protected $queryString = ['type'];

    public function render()
    {
        return view('mito::livewire.show-posts', [
            'posts' => Post::where('status', $this->type)->latest($this->type === 'published' ? 'published_at' : 'created_at')->get(),
        ])->layout('mito::layouts.html');
    }
}
