<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChiTietDonHang extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'don_gia',
        'so_luong',
        'thanh_tien',
        'san_pham_id',
        'don_hang_id',
        'promotion_id',
    ];
public function donHang(){
    return $this->belongsTo(DonHang::class);

}
public function sanPham(){
    return $this->belongsTo(SanPham::class);
    
}
}
