<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Tạo trường id tự động tăng
            $table->string('name');
            $table->float('weight'); // Hoặc dùng decimal nếu cần độ chính xác cao hơn
            $table->integer('calories');
            $table->decimal('price', 10, 2); // 10 chữ số tổng cộng, với 2 chữ số sau dấu thập phân
            $table->decimal('rating', 3, 2); // 3 chữ số tổng cộng, với 2 chữ số sau dấu thập phân
            $table->string('image');
            $table->text('images'); // Dùng text để lưu nhiều hình ảnh, có thể lưu dưới dạng JSON
            $table->json('sizes'); // Dùng JSON để lưu mảng sizes
            $table->string('size');
            $table->json('colors'); // Dùng JSON để lưu mảng colors
            $table->string('color');
            $table->text('description');
            $table->string('categories'); // Có thể là JSON nếu lưu nhiều danh mục
            $table->boolean('is_bestseller')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_out_of_stock')->default(false);
            $table->decimal('old_price', 10, 2)->nullable(); // Có thể để null nếu không có giá cũ
            $table->integer('quantity')->nullable(); // Có thể để null nếu không có số lượng
            $table->json('reviews'); // Dùng JSON để lưu mảng reviews
            $table->boolean('is_new')->default(false);
            $table->string('category'); // Dùng JSON để lưu mảng category
            $table->timestamps(); // Tạo created_at và updated_at

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null'); // Thiết lập khóa ngoại
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};