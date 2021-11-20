<?php

namespace Mito\Http\Livewire;

use Illuminate\Contracts\Container\BindingResolutionException;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

trait HasImages
{
    use WithFileUploads;

    public function storeImage(UploadedFile $image): string|false
    {
        return $image->storePublicly(
            'images',
            ['disk' => $this->imagesDisk()]
        );
    }

    public function getImageUrl(string $imagePath): string
    {
        return Storage::disk($this->imagesDisk())->url($imagePath);
    }

    protected function imagesDisk(): string
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('mito.images_disk', 'public');
    }
}
