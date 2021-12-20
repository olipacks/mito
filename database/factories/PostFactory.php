<?php

namespace Olipacks\Mito\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Olipacks\Mito\Models\Post;
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

    public function published(): self
    {
        return $this->state([
            'status' =>  'published',
            'published_at' => $this->faker->dateTimeBetween('-1 month'),
        ]);
    }

    public function scheduled(): self
    {
        return $this->state([
            'status' =>  'scheduled',
            'published_at' => $this->faker->dateTimeBetween('now', '+1 month'),
        ]);
    }

    public function draft(): self
    {
        return $this->state([
            'status' =>  'draft',
        ]);
    }

    public function emptyDraft(): self
    {
        return $this->state([
            'markdown' => null,
            'status' =>  'draft',
            'published_at' => null,
        ]);
    }
}

