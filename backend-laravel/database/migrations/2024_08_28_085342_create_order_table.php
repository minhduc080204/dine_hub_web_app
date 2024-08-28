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
        Schema::create('order', function (Blueprint $table) {
            $table->id(); // Tạo trường id tự động tăng
            $table->string('name'); // Tên khách hàng
            $table->string('email'); // Email khách hàng
            $table->string('phone_number'); // Số điện thoại
            $table->text('address'); // Địa chỉ
            $table->decimal('total_price', 10, 2); // Tổng giá
            $table->decimal('subtotal_price', 10, 2); // Giá trước thuế
            $table->decimal('delivery_price', 10, 2); // Giá giao hàng
            $table->decimal('discount', 10, 2); // Khuyến mãi
            $table->string('payment_status'); // Trạng thái thanh toán
            $table->string('order_status'); // Trạng thái đơn hàng
            $table->timestamps(); // Tạo created_at và updated_at

            $table->unsignedBigInteger('product_id'); // Khóa ngoại tới bảng products
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
