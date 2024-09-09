<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'note'=>'not thing',
            'user_id' => '1',
            'address' => 'Việt Nam',
            'total_price' => $this->faker->randomFloat(2, 50, 1000),
            'subtotal_price' => $this->faker->randomFloat(2, 50, 1000),
            'delivery_price' => $this->faker->randomFloat(2, 5, 50),
            'discount' => $this->faker->randomFloat(2, 0, 100),
            'payment_status' => $this->faker->randomElement(['Paid', 'Pending']),
            'order_status' => $this->faker->randomElement(['Processing', 'Completed', 'Cancelled']),
            'product_id' => Product::inRandomOrder()->first()->id, // Random product ID
        ];
    }
}