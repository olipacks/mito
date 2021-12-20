<?php

namespace Olipacks\Mito\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Olipacks\Mito\Models\Post;

class ShowPosts extends Component
{
    use WithDraftCreation;

    public string $type = 'draft';

    /**
     * @var array
     */
    protected $queryString = ['type'];

    public function render(): View
    {
        return view('mito::livewire.show-posts', [
            'posts' => Post::where('status', $this->type)->latest($this->type === 'draft' ? 'created_at' : 'published_at')->get(),
        ])->layout('mito::layouts.html');
    }
}
