<?php

namespace Mito\Http\Livewire;

use Illuminate\Http\UploadedFile;
use Illuminate\View\View;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Mito\Models\Post;

class ManagePostSettings extends ModalComponent
{
    use WithFileUploads;

    public int|Post $post;

    public string $slug;

    public string|UploadedFile $image = '';

    protected function rules(): array
    {
        if (! ($this->post instanceof Post)) {
            return [];
        }

        return [
            'slug' => ['required', 'string', 'max:255', 'unique:mito_posts,slug,'.$this->post['id']],
        ];
    }

    public function save(string $propertyName): void
    {
        if (! ($this->post instanceof Post)) {
            return;
        }

        $this->validateOnly($propertyName);

        if ($propertyName === 'slug') {
            $this->post->slug = $this->slug;
        }

        $this->post->save();

        $this->emitSelf('notify-saved', $propertyName);
    }

    public function saveImage(): void
    {
        $this->validate([
            'image' => ['required', 'image', 'max:10240'], // 10MB Max
        ]);

        if (! ($this->post instanceof Post)) {
            return;
        }

        if (! ($this->image instanceof UploadedFile)) {
            return;
        }

        $this->post->fill([
            'feature_image_path' => $this->post->storeImage($this->image),
        ])->save();

        $this->emitSelf('notify-saved', 'image');
    }

    public function updatedImage(): void
    {
        $this->validate([
            'image' => 'image',
        ]);
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
