<?php

namespace Olipacks\Mito\Http\Livewire;

use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;
use Olipacks\Mito\Models\Post;

class DeletePost extends ModalComponent
{
    public int|Post $post;
    public string $type;

    public function mount(Post $post): void
    {
        $this->post = $post;
        $this->type = $post->status;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function delete()
    {
        if (! ($this->post instanceof Post)) {
            return;
        }

        $this->post->delete();

        return redirect()->to(route('mito.posts.index', ['type' => $this->type]));
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render(): View
    {
        return view('mito::livewire.confirm-delete-post');
    }
}
