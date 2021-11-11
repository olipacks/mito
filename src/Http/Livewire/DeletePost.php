<?php

namespace Mito\Http\Livewire;

use LivewireUI\Modal\ModalComponent;
use Mito\Models\Post;

class DeletePost extends ModalComponent
{
    public int|Post $post;
    public $type;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->type = $post->status;
    }

    public function delete()
    {
        $this->post->delete();

        return redirect()->to(route('mito.posts.index', ['type' => $this->type]));
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render()
    {
        return view('mito::livewire.confirm-delete-post');
    }
}
