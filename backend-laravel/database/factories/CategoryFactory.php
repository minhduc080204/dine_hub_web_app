<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word, // Tạo dữ liệu giả cho cột 'name'
            'image' => $this->faker->optional()->imageUrl(), // Tạo dữ liệu giả cho cột 'image', có thể là null
            'quantity' => $this->faker->optional()->numberBetween(1, 100), // Tạo dữ liệu giả cho cột 'quantity', có thể là null
        ];
    }
}