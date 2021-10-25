<?php

namespace Mito\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    public $table = 'mito_posts';

    protected $guarded = [];

    public function getTitleAttribute()
    {
        return Str::after(collect(explode(PHP_EOL, $this->markdown))
            ->first(function ($value) {
                return Str::of($value)->trim()->isNotEmpty();
            }), '# ');
    }

    public function getLeadAttribute()
    {
        return collect(explode(PHP_EOL, $this->markdown))
            ->slice(1)
            ->first(function ($value) {
                return Str::of($value)->trim()->isNotEmpty();
            });
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

    public function markAsPublished()
    {
        $this->update([
            'published_at' => $this->published_at ?? $this->freshTimestamp(),
            'status' => 'published',
        ]);
    }
}
