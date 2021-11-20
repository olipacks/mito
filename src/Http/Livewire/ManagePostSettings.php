<?php

namespace Mito\Http\Livewire;

use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;
use Mito\Models\Post;

class ManagePostSettings extends ModalComponent
{
    public int|Post $post;

    public string $slug;

    protected function rules(): array
    {
        return [
            'slug' => ['required', 'string', 'max:255', 'unique:mito_posts,slug,'.$this->post['id']],
        ];
    }

    public function save(string $propertyName): void
    {
        $this->validateOnly($propertyName);

        if ($propertyName === 'slug') {
            $this->post->slug = $this->slug;
        }

        $this->post->save();

        $this->emitSelf('notify-saved', $propertyName);
    }

    public function mount(Post $post): void
    {
        $this->post = $post;
        $this->slug = $post->slug ?? '';
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render(): View
    {
        return view('mito::livewire.manage-post-settings');
    }
}
