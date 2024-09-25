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
        Schema::create('slides', function (Blueprint $table) {
            $table->id(); // Tạo cột 'id' kiểu auto-increment
            $table->string('title_line_1'); // Cột 'title_line_1' kiểu string
            $table->string('title_line_2'); // Cột 'title_line_2' kiểu string
            $table->string('image'); // Cột 'image' kiểu string
            $table->string('button_text'); // Cột 'button_text' kiểu string
            $table->timestamps(); // Cột 'created_at' và 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slides');
    }
};