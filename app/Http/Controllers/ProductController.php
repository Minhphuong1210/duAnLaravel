<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\SanPham;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function trangchuSanPham()
    {
        $danhMuc = DanhMuc::with('sanPhams')
            ->where('trang_thai', '=', 1)
            ->get();
        $sanPham_is_new = SanPham::query()->where('is_new', '=', 1)->limit(6)->latest('id')->get();
        $sanPham_is_hot_deal = SanPham::query()->where('is_hot_deal', '=', 1)->limit(16)->latest('id')->get();
        $sanPham_is_hot = SanPham::query()->where('is_hot', '=', 1)->limit(8)->latest('id')->get();
        $sanPham_is_show_home = SanPham::query()->where('is_show_home', '=', 1)->limit(8)->latest('id')->get();
        return view('views.sanphams.trangchu', compact('danhMuc', 'sanPham_is_new', 'sanPham_is_hot_deal', 'sanPham_is_hot', 'sanPham_is_show_home'));
    }

    public function chiTietSanPham(string $id, string $danh_muc_id)
    {
        $sanPham = SanPham::query()->findOrFail($id);
        $danhMuc = DanhMuc::query()->findOrFail($danh_muc_id);
        $sanPhamsCungDanhMuc = $danhMuc->sanPhams;
        // dd($sanPhamsCungDanhMuc);
        return view('views.sanphams.chiTietSanPham', compact('sanPham', 'sanPhamsCungDanhMuc'));
    }

    public function cate(string $id)
    {
        $danhMucTong = DanhMuc::query()->where('trang_thai','=','1')->get();

        $danhMuc = DanhMuc::query()->findOrFail($id);
        
        $sanPhamsCungDanhMuc = $danhMuc->sanPhams;
        // dd($danhMucTong);
        return view('views.sanphams.danhMuc', compact('danhMucTong','danhMuc','sanPhamsCungDanhMuc'));

    }

    public function search(Request $request){
        $keyword = $request->input('keyword');
        $sanPhams = SanPham::query();
        if ($keyword) {
            $sanPhams->where('ten_san_pham', 'like', "%{$keyword}%")
                     ->orWhere('mo_ta_ngan', 'like', "%{$keyword}%");
        }
        $sanPhams = $sanPhams->get(); 
    //    dd($sanPhams);
        return view('views.sanphams.search', compact('sanPhams'));
    }
}
