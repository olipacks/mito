<?php

namespace Olipacks\Mito\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\MarkdownConverterInterface;
use Olipacks\Mito\Database\Factories\PostFactory;

class Post extends Model
{
    use HasFactory;

    public $table = 'mito_posts';

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'date:Y-m-d H:i:s',
        'meta' => AsCollection::class,
    ];

    protected static function newFactory(): Factory
    {
        return PostFactory::new();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'mito_posts_tags', 'post_id', 'tag_id');
    }

    public function scopeHasTag($query, string $slug): void
    {
        $query->whereHas('tags', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });
    }

    public function scopeDoesntHaveTag($query, string $slug): void
    {
        $query->whereDoesntHave('tags', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'published');
    }

    public function scopeDraft(Builder $query): void
    {
        $query->where('status', 'draft');
    }

    public function scopeScheduled(Builder $query): void
    {
        $query->where('status', 'scheduled');
    }

    public function getTitleAttribute(): string
    {
        $firstNotEmptyLine = collect(explode(PHP_EOL, $this->markdown ?? ''))
            ->first(function ($value) {
                return Str::of($value)->trim()->isNotEmpty();
            });

        return Str::after($firstNotEmptyLine ?? '', '# ');
    }

    public function getExcerptAttribute(): string|null
    {
        $markdownExcerpt = collect(explode(PHP_EOL, $this->markdown ?? ''))
            ->slice(1)
            ->first(function ($value) {
                return Str::of($value)->trim()->isNotEmpty();
            });

        return $markdownExcerpt ?
            strip_tags($this->markdownConverter()->convertToHtml($markdownExcerpt)) :
            null;
    }

    public function getMarkdownWithoutTitleAttribute(): string
    {
        return collect(explode(PHP_EOL, $this->markdown ?? ''))
            ->slice(1)
            ->implode(PHP_EOL);
    }

    public function setSlugAttribute(string $value): void
    {
        if (static::whereSlug($slug = Str::slug($value))->exists()) {
            $slug = $this->incrementSlug($slug);
        }

        $this->attributes['slug'] = $slug;
    }

    public function incrementSlug(string $slug): string
    {
        $original = $slug;
        $count = 2;

        while (static::whereSlug($slug)->exists()) {
            $slug = "{$original}-" . $count++;
        }

        return $slug;
    }

    public function isEmpty(): bool
    {
        return Str::of($this->markdown ?? '')->trim()->isEmpty();
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

    public function markAsPublished(): void
    {
        $this->update([
            'published_at' => $this->published_at ?? $this->freshTimestamp(),
            'status' => 'published',
        ]);
    }

    public function markAsDraft(): void
    {
        $this->update([
            'published_at' => $this->isScheduled() ? null : $this->published_at,
            'status' => 'draft',
        ]);
    }

    public function markAsScheduled(Carbon $publishDate): void
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
