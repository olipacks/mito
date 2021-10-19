<?php

namespace Mito\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Mito\Models\Post;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        $title = $this->faker->words(3, true);
        $status = $this->faker->randomElement(['draft', 'published']);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'markdown' => $this->faker->paragraph(),
            'status' => $status,
            'published_at' => $status === 'published' ? $this->faker->dateTimeBetween('-1 month') : NULL,
        ];
    }

    public function published()
    {
        return $this->state([
            'status' =>  'published',
            'published_at' => $this->faker->dateTimeBetween('-1 month'),
        ]);
    }

    public function draft()
    {
        return $this->state([
            'status' =>  'draft',
        ]);
    }
}

