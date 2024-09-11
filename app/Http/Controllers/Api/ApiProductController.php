<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BaiViet;
use App\Models\Comment;
use App\Models\DanhMuc;
use App\Models\SanPham;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    public function trangchuSanPham()
    {
        $sanpham = SanPham::query()->get();
        $danhMuc = DanhMuc::with('sanPhams')
            ->where('trang_thai', '=', 1)
            ->get();
        $sanPham_is_new = SanPham::query()->where('is_new', '=', 1)->limit(6)->latest('id')->get();
        $sanPham_is_hot_deal = SanPham::query()->where('is_hot_deal', '=', 1)->limit(16)->latest('id')->get();
        $sanPham_is_hot = SanPham::query()->where('is_hot', '=', 1)->limit(8)->latest('id')->get();
        $sanPham_is_show_home = SanPham::query()->where('is_show_home', '=', 1)->limit(8)->latest('id')->get();
        $comment = Comment::query()->latest('id')->limit(4)->get();
        $post = BaiViet::query()->limit(5)->latest('id')->get();
        return response()->json([
            'danhMuc' => $danhMuc,
            'sanPham_is_new' => $sanPham_is_new,
            'sanPham_is_hot_deal' => $sanPham_is_hot_deal,
            'sanPham_is_hot' => $sanPham_is_hot,
            'sanPham_is_show_home' => $sanPham_is_show_home,
            'comment' => $comment,
            'post' => $post,
        ]);
    }
}
