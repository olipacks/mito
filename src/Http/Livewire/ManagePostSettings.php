<?php

namespace Mito\Http\Livewire;

use LivewireUI\Modal\ModalComponent;
use Mito\Models\Post;

class ManagePostSettings extends ModalComponent
{
    public int|Post $post;

    protected function rules()
    {
        return [
            'post.custom_slug' => ['required', 'string', 'max:255', 'unique:mito_posts,slug,'.$this->post['id']],
        ];
    }

    public function save($propertyName)
    {
        $this->validateOnly($propertyName);

        if ($propertyName === 'post.custom_slug') {
            $this->post->slug = $this->post->custom_slug;
        }

        $this->post->save();

        $this->dispatchBrowserEvent('notify', 'Saved');
    }

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render()
    {
        return view('mito::livewire.manage-post-settings');
    }
}
