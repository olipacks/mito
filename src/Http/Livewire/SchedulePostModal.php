<?php

namespace Mito\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;
use Mito\Models\Post;

class SchedulePostModal extends ModalComponent
{
    public int|Post $post;
    public $publishDate = null;
    public $day = null;
    public $month = null;
    public $year = null;
    public $hour = null;
    public $minute = null;

    protected $messages = [
        'publishDate.date_format' => 'The publish date does not match the format DD-MM-YYYY HH:MM.',
    ];

    protected function rules()
    {
        return [
            'publishDate' => ['required', 'date_format:Y-m-d H:i'],
        ];
    }

    public function schedule()
    {
        $this->publishDate = "{$this->year}-{$this->month}-{$this->day} {$this->hour}:{$this->minute}";

        $this->validate();

        if (is_null($this->post->slug)) {
            $this->post->fill([
                'slug' => Str::slug($this->post->title),
            ])->save();
        }

        $this->post->markAsScheduled(Carbon::parse($this->publishDate));

        $this->type = 'scheduled';

        $this->dispatchBrowserEvent('notify', 'Scheduled!');
    }

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->published_at = now();
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
