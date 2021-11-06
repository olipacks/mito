<?php

namespace Mito\Http\Livewire;

use Mito\Models\Post;

trait WithDraftCreation
{
    public function createDraft()
    {
        $draft = Post::create();

        return redirect()->to(route('mito.posts.edit', $draft));
    }
}
