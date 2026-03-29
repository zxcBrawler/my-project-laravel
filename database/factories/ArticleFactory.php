<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    protected $model = \App\Models\Article::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(rand(3, 8));
        $categories = ['наука', 'технологии', 'спорт', 'культура', 'политика', 'экономика', 'интересное'];
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'short_description' => $this->faker->paragraph(rand(1, 2)),
            'content' => $this->faker->paragraphs(rand(5, 15), true),
            'preview_image' => $this->faker->randomElement(['preview.jpg', 'preview_2.jpg', null]),
            'full_image' => $this->faker->randomElement(['full.jpeg', 'full_2.jpeg', null]),
            'category' => $this->faker->randomElement($categories),
            'views' => $this->faker->numberBetween(0, 10000),
            'published_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'is_published' => $this->faker->boolean(95),
        ];
    }

    public function unpublished()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_published' => false,
            ];
        });
    }
    
    public function popular()
    {
        return $this->state(function (array $attributes) {
            return [
                'views' => $this->faker->numberBetween(5000, 50000),
            ];
        });
    }
}
