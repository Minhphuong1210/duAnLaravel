<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;

    const TRANG_THAI_DON_HANG = [
        'cho_xac_nha' => 'Chờ xác nhận',
        'da_xac_nha' => 'Đã xác nhận',
        'dang_chuan_bi' => 'Đang chuẩn bị',
        'dang_van_chuyen' => 'Đang vận chuyển',
        'da_nhan_hang' => 'Đã nhận hàng',
        'huy_hang' => 'Hủy hàng',
    ];

    const TRANG_THAI_THANH_TOAN = [
        'chua_thanh_toan' => 'Chưa thanh toán',
        'da_thanh_toan' => 'Đã thanh toán',
    ];

    const CHO_XAC_NHA = 'cho_xac_nha';
    const DA_XAC_NHA = 'da_xac_nha';
    const DANG_CHUAN_BI = 'dang_chuan_bi';
    const DANG_VAN_CHUYEN = 'dang_van_chuyen';
    const DA_NHAN_HANG = 'da_nhan_hang';
    const HUY_HANG = 'huy_hang';
    const CHUA_THANH_TOAN = 'chua_thanh_toan';
    const DA_THANH_TOAN = 'da_thanh_toan';

    protected $fillable = [
        'ma_don_hang',
        'user_id',
        'ten_nguoi_nhan',
        'email',
        'sđt',
        'dia_chi',
        'ghi_chu',
        'trang_thai_don_hang',
        'trang_thai_thanh_toan',
        'tien_hang',
        'tien_ship',
        'tong_tien',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chiTietDonHang()
    {
        return $this->hasMany(ChiTietDonHang::class);
    }
}
