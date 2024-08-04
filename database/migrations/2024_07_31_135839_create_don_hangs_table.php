<?php

use App\Models\DonHang;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_don_hang')->unique();

            // lưu trữ thông tin tài khoản đã đặt hàng 
            $table->foreignIdFor(User::class)->constrained();

            // lưu trữ thông tin của người nhận 
            $table->string('ten_nguoi_nhan');
            $table->string('email');
            $table->string('sđt', 10);
            $table->text('dia_chi');
            $table->text('ghi_chu')->nullable();

            // lưu trữ thông tin để quản lí đơn hàng 
            $table->string('trang_thai_don_hang')->default(DonHang::CHO_XAC_NHA);
            $table->string('trang_thai_thanh_toan')->default(DonHang::CHUA_THANH_TOAN);

            $table->double('tien_hang'); // 
            $table->double('tien_ship');
            $table->double('tong_tien'); // có mã khuyến mãi thì trừ đi 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hangs');
    }
};
