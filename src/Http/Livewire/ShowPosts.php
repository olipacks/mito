<?php

namespace Mito\Http\Livewire;

use Livewire\Component;
use Mito\Models\Post;

class ShowPosts extends Component
{
    public $type = 'draft';

    protected $queryString = ['type'];

    public function createDraft()
    {
        $draft = Post::create();

        return redirect()->to(route('mito.posts.edit', $draft));
    }

    public function mount()
    {
        $latestPost = Post::where('status', $this->type)->latest()->first();

        if ($latestPost) {
            return redirect(route('mito.posts.edit', $latestPost));
        }
    }

    public function render()
    {
        return view('mito::livewire.empty')->layout('mito::layouts.html');
    }
}
