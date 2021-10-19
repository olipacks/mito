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
        return Str::after(collect(explode(PHP_EOL, $this->markdown))->first(), '# ');
    }

    public function setSlugAttribute($value) {
        if (empty($value)) {
            $value = 'untitled';
        }

        if (static::whereSlug($slug = Str::slug($value))->exists()) {
            $slug = $this->incrementSlug($slug);
        }

        $this->attributes['slug'] = $slug;
    }

    public function incrementSlug($slug) {
        $original = $slug;
        $count = 2;

        while (static::whereSlug($slug)->exists()) {
            $slug = "{$original}-" . $count++;
        }

        return $slug;
    }
}
