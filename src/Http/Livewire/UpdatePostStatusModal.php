<?php

namespace Olipacks\Mito\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;
use Olipacks\Mito\Models\Post;

class UpdatePostStatusModal extends ModalComponent
{
    public int|Post $post;
    public string $publishDateTime;
    public string $status;
    public string $date;
    public string $time;

    protected array $messages = [
        'publishDateTime.date_format' => 'The publish date and time do not match the format DD-MM-YYYY HH:MM.',
    ];

    protected function rules(): array
    {
        return [
            'publishDateTime' => ['required', 'date_format:Y-m-d H:i'],
        ];
    }

    public function update(): void
    {
        match ($this->status) {
            'published' => $this->publish(),
            'scheduled' => $this->schedule(),
            'draft' => $this->unpublish(),
            default => $this->unpublish(),
        };
    }

    protected function publish(): void
    {
        if (! ($this->post instanceof Post)) {
            return;
        }

        if (is_null($this->post->slug)) {
            $this->post->fill([
                'slug' => Str::slug($this->post->title),
            ])->save();
        }

        $this->post->markAsPublished();

        $this->forceClose()->closeModal();

        $this->emit('typeUpdated', 'published');

        $this->dispatchBrowserEvent('notify', 'Published!');
    }

    protected function unpublish(): void
    {
        if (! ($this->post instanceof Post)) {
            return;
        }

        $this->post->markAsDraft();

        $this->forceClose()->closeModal();

        $this->emit('typeUpdated', 'draft');

        $this->dispatchBrowserEvent('notify', 'Unpublished!');
    }

    protected function schedule(): void
    {
        if (! ($this->post instanceof Post)) {
            return;
        }

        $this->publishDateTime = "{$this->date} {$this->time}";

        $this->validate();

        if (is_null($this->post->slug)) {
            $this->post->fill([
                'slug' => Str::slug($this->post->title),
            ])->save();
        }

        $this->post->markAsScheduled(Carbon::parse($this->publishDateTime));

        $this->forceClose()->closeModal();

        $this->emit('typeUpdated', 'scheduled');

        $this->dispatchBrowserEvent('notify', 'Scheduled!');
    }

    public function mount(Post $post): void
    {
        $this->post = $post;
        $this->status = $post->status;
        $this->date = now()->format('Y-m-d');
        $this->time = now()->addMinutes(5)->format('H:i');
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render(): View
    {
        return view('mito::livewire.schedule-post-modal');
    }
}
