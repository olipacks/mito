<?php

namespace Mito\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $table = 'mito_posts';

    protected $guarded = [];
}
