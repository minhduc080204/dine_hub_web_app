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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Tạo trường id tự động tăng
            $table->string('user_name')->nullable(); // Trường user_name có thể để trống
            $table->string('email')->unique()->nullable(); // Trường email là duy nhất và có thể để trống
            $table->string('password')->nullable(); // Trường password có thể để trống
            // $table->string('confirm_password')->nullable(); // Trường confirm_password có thể để trống
            $table->string('phone_number')->nullable(); // Trường phone_number có thể để trống
            $table->string('otp')->nullable(); // Trường otp có thể để trống
            $table->string('role')->nullable(); // Trường code có thể để trống
            $table->timestamps(); // Tạo created_at và updated_at
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};