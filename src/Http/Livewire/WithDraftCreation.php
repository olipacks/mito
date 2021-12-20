<?php

namespace Olipacks\Mito\Http\Livewire;

use Olipacks\Mito\Models\Post;

trait WithDraftCreation
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createDraft()
    {
        $draft = Post::create();

        return redirect()->to(route('mito.posts.edit', $draft));
    }
}
