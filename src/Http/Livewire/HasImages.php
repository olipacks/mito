<?php

namespace Olipacks\Mito\Http\Livewire;

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
        if (isset($_ENV['VAPOR_ARTIFACT_NAME'])) {
            return 's3';
        }

        if (is_string($disk = config('mito.images_disk', 'public'))) {
            return $disk;
        }

        return 'public';
    }
}
