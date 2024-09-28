<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_name' => $this->faker->userName, // Tạo tên người dùng ngẫu nhiên
            'email' => $this->faker->unique()->safeEmail, // Tạo email duy nhất
            'password' => Hash::make('password'), // Mã hóa mật khẩu mặc định
            // 'confirm_password' => bcrypt('password'), // Mã hóa confirm_password
            'phone_number' => $this->faker->optional()->phoneNumber, // Tạo số điện thoại ngẫu nhiên, có thể để trống
            'otp' => $this->faker->optional()->numerify('######'), // Tạo OTP ngẫu nhiên, có thể để trống
            'code' => $this->faker->optional()->word, // Tạo code ngẫu nhiên, có thể để trống
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}