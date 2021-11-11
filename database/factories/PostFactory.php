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
        $status = $this->faker->randomElement(['draft', 'published']);

        return [
            'markdown' => $this->faker->paragraph(),
            'status' => $status,
            'published_at' => $status === 'published' ? $this->faker->dateTimeBetween('-1 month') : null,
        ];
    }

    public function published()
    {
        return $this->state([
            'status' =>  'published',
            'published_at' => $this->faker->dateTimeBetween('-1 month'),
        ]);
    }

    public function scheduled()
    {
        return $this->state([
            'status' =>  'scheduled',
            'published_at' => $this->faker->dateTimeBetween('now', '+1 month'),
        ]);
    }

    public function draft()
    {
        return $this->state([
            'status' =>  'draft',
        ]);
    }

    public function emptyDraft()
    {
        return $this->state([
            'markdown' => null,
            'status' =>  'draft',
            'published_at' => null,
        ]);
    }
}

