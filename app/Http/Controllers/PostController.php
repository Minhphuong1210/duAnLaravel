<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use App\Models\DanhMuc;
use App\Models\SanPham;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function allPost()
    {
        $post = BaiViet::query()->paginate(6);
        return view('views.baiviets.allPost', compact('post'));
    }
    public function detail(string $id)
    {

        $category = DanhMuc::query()->where('trang_thai','=','1')->get();
        $post  = BaiViet::query()->findOrFail($id);
        $posts_view = BaiViet::query()->orderBy('view', 'desc')->limit(5)->get();
     
        // tự động tăng thêm 1 của eloquent
        $post->increment('view');
        return view('views.baiviets.postDetail', compact('post','category','posts_view'));
    }
}
