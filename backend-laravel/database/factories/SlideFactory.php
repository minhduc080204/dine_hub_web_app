<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slide>
 */
class SlideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title_line_1' => $this->faker->sentence,
            'title_line_2' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(),
            'button_text' => $this->faker->word,
        ];
    }
}
