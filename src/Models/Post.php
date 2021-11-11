<?php

namespace Mito\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\MarkdownConverterInterface;
use Mito\Database\Factories\PostFactory;

class Post extends Model
{
    use HasFactory;

    public $table = 'mito_posts';

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'date:Y-m-d H:i:s',
        'meta' => AsCollection::class,
    ];

    protected static function newFactory()
    {
        return PostFactory::new();
    }

    public function scopePublished($query)
    {
        $query->where('status', 'published');
    }

    public function scopeDraft($query)
    {
        $query->where('status', 'draft');
    }

    public function scopeScheduled($query)
    {
        $query->where('status', 'scheduled');
    }

    public function getTitleAttribute()
    {
        return Str::after(collect(explode(PHP_EOL, $this->markdown))
            ->first(function ($value) {
                return Str::of($value)->trim()->isNotEmpty();
            }), '# ');
    }

    public function getExcerptAttribute()
    {
        $markdownExcerpt = collect(explode(PHP_EOL, $this->markdown))
            ->slice(1)
            ->first(function ($value) {
                return Str::of($value)->trim()->isNotEmpty();
            });

        return $markdownExcerpt ?
            strip_tags($this->markdownConverter()->convertToHtml($markdownExcerpt)) :
            null;
    }

    public function getMarkdownWithoutTitleAttribute()
    {
        return collect(explode(PHP_EOL, $this->markdown))
            ->slice(1)
            ->implode(PHP_EOL);
    }

    public function setSlugAttribute($value)
    {
        if (static::whereSlug($slug = Str::slug($value))->exists()) {
            $slug = $this->incrementSlug($slug);
        }

        $this->attributes['slug'] = $slug;
    }

    public function incrementSlug($slug)
    {
        $original = $slug;
        $count = 2;

        while (static::whereSlug($slug)->exists()) {
            $slug = "{$original}-" . $count++;
        }

        return $slug;
    }

    public function isEmpty()
    {
        return Str::of($this->markdown)->trim()->isEmpty();
    }

    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    public function isScheduled(): bool
    {
        return $this->status === 'scheduled';
    }

    public function markAsPublished()
    {
        $this->update([
            'published_at' => $this->published_at ?? $this->freshTimestamp(),
            'status' => 'published',
        ]);
    }

    public function markAsDraft()
    {
        $this->update([
            'published_at' => $this->isScheduled() ? null : $this->published_at,
            'status' => 'draft',
        ]);
    }

    public function markAsScheduled(Carbon $publishDate)
    {
        $this->update([
            'published_at' => $publishDate,
            'status' => 'scheduled',
        ]);
    }

    protected function markdownConverter(): MarkdownConverterInterface
    {
        return new CommonMarkConverter([
            'html_input' => 'strip',
        ]);
    }
}
