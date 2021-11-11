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
            'posts' => Post::where('status', $this->type)->latest($this->type === 'draft' ? 'created_at' : 'published_at')->get(),
        ])->layout('mito::layouts.html');
    }
}
