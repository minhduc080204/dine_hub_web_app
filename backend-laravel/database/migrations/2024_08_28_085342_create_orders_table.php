<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id()->constrained()->onDelete('cascade'); // Tạo trường id tự động tăng
            $table->string('address');
            $table->text('qrcode')->nullable();
            $table->string('note')->nullable();
            $table->decimal('total_price', 10, 2); // Tổng giá
            $table->decimal('subtotal_price', 10, 2); // Giá trước thuế
            $table->decimal('delivery_price', 10, 2); // Giá giao hàng
            $table->decimal('discount', 10, 2); // Khuyến mãi
            $table->string('payment_status'); // Trạng thái thanh toán
            $table->string('order_status'); // Trạng thái đơn hàng
            $table->json('product_id');
            $table->timestamps(); // Tạo created_at và updated_at

            $table->unsignedBigInteger('user_id'); // Khóa ngoại tới bảng users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreignId('product_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};