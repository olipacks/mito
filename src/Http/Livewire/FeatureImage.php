<?php

namespace Mito\Http\Livewire;

use Illuminate\Http\UploadedFile;
use Illuminate\View\View;
use Livewire\Component;

class FeatureImage extends Component
{
    use HasImages;

    public string|UploadedFile $image = '';

    public function updatedImage(): void
    {
        $this->validate([
            'image' => 'image',
        ]);
    }

    public function save(): void
    {
        $this->validate([
            'image' => ['required', 'image', 'max:10240'], // 10MB Max
        ]);

        $this->storeImage($this->image);
    }

    public function render(): View
    {
        return view('mito::livewire.feature-image')->layout('mito::layouts.html');
    }
}
