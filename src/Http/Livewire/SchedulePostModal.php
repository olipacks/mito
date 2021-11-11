<?php

namespace Mito\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;
use Mito\Models\Post;

class SchedulePostModal extends ModalComponent
{
    public int|Post $post;
    public $publishDateTime = null;
    public $date = null;
    public $time = null;

    protected $messages = [
        'publishDateTime.date_format' => 'The publish date and time do not match the format DD-MM-YYYY HH:MM.',
    ];

    protected function rules()
    {
        return [
            'publishDateTime' => ['required', 'date_format:Y-m-d H:i'],
        ];
    }

    public function schedule()
    {
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

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->date = now()->format('Y-m-d');
        $this->time = now()->addMinutes(5)->format('H:i');
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render()
    {
        return view('mito::livewire.schedule-post-modal');
    }
}
