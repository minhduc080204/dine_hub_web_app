<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Slide;
use App\Models\Tag;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User::factory(5)->create();
        User::create([
            'user_name' => 'user1',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('Duc08022004'), // Hoặc Hash::make('password1')
            'phone_number' => '1234567890',
            'otp' => '123456',
            'role' => '',
        ]);

        User::create([
            'user_name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Duc08022004'),
            'phone_number' => '0987654321',
            'otp' => '654321',
            'role' => 'admin',
        ]);
        Product::factory(5)->create();
        Category::factory(5)->create();
        Tag::factory(5)->create();
        Slide::factory(5)->create();
        
        
    }
}