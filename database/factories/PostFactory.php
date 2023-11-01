<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'photo' => $this->faker->imageUrl,
            'body' => ['abc'],
        ];
    }

    public function untitled(): PostFactory|Factory
    {
        return $this->state([
            'title' => 'untitled'
        ]);
    }
}
