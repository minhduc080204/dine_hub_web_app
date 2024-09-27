<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word . ' Sale',
            'discount' => $this->faker->numberBetween(5, 50), // Tạo giá trị giảm giá ngẫu nhiên từ 5 đến 50
            'code' => $this->faker->word . strtoupper($this->faker->lexify('???')), // Tạo mã giảm giá ngẫu nhiên
            'expires_at' => $this->faker->dateTimeBetween('+1 week', '+2 months')->format('Y-m-d H:i:s'), // Ngày hết hạn trong khoảng từ 1 tuần đến 2 tháng
        ];
    }
}