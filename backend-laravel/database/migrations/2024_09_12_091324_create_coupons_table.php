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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id(); // Tạo cột id với kiểu number (bigint, auto-increment)
            $table->string('name')->nullable(); // Tạo cột name với kiểu string
            $table->decimal('discount', 8); // Tạo cột discount với kiểu decimal, ví dụ: 100.00
            $table->string('code'); // Tạo cột code với kiểu string
            $table->date('expires_at')->nullable(); // Tạo cột expires_at với kiểu timestamp, có thể null
            $table->timestamps(); // Tạo các cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};