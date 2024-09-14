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
        // Product::factory(5)->create();
        // Category::factory(5)->create();
        // Slide::factory(5)->create();
        // Tag::factory(5)->create();
        // Order::factory(5)->create();
        Discount::factory(5)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Product::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}