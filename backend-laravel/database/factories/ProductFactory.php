<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'weight' => $this->faker->randomFloat(2, 0, 100), // Random float with 2 decimal places
            'calories' => $this->faker->numberBetween(50, 1000),
            'price' => $this->faker->randomFloat(2, 5, 500),
            'rating' => $this->faker->randomFloat(2, 1, 5),
            'image' => $this->faker->imageUrl(),
            'images' => json_encode([$this->faker->imageUrl(), $this->faker->imageUrl()]), // Example JSON array
            'sizes' => json_encode($this->faker->words(3)), // Example JSON array
            'size' => $this->faker->word,
            'colors' => json_encode($this->faker->words(3)), // Example JSON array
            'color' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'categories' => $this->faker->word,
            'is_bestseller' => $this->faker->boolean,
            'is_featured' => $this->faker->boolean,
            'is_out_of_stock' => $this->faker->boolean,
            'old_price' => $this->faker->optional()->randomFloat(2, 5, 500), // Optional old price
            'quantity' => $this->faker->optional()->numberBetween(0, 100),
            'reviews' => json_encode([
                ['review' => $this->faker->sentence, 'rating' => $this->faker->randomFloat(2, 1, 5)],
                ['review' => $this->faker->sentence, 'rating' => $this->faker->randomFloat(2, 1, 5)],
            ]), // Example JSON array
            'is_new' => $this->faker->boolean,
            'category' => json_encode([$this->faker->word, $this->faker->word]), // Example JSON array
        ];
    }
}