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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique(); 
            $table->decimal('discount', 10, 2); // kiểu khuyến mại theo giá hay theo %
            $table->enum('discount_type', ['percentage', 'fixed']); // chọn giảm giá theo khuyến mại hay phần trăm
            $table->date('start_date'); // Ngày bắt đầu 
            $table->date('end_date'); // Ngày kết thúc
            $table->integer('usage_limit')->nullable(); // Số lần sử dụng
            $table->enum('status', ['active', 'inactive'])->default('active'); // trạng thái của khuyến mại
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
