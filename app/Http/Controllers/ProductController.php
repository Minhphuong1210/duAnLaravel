<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use App\Models\Comment;
use App\Models\DanhMuc;
use App\Models\SanPham;
use App\Models\User;
use Illuminate\Http\Request;
use Mail;

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
        $comment = Comment::query()->latest('id')->limit(4)->get();

        return view('views.sanphams.trangchu', compact('danhMuc', 'sanPham_is_new', 'sanPham_is_hot_deal', 'sanPham_is_hot', 'sanPham_is_show_home', 'comment'));
    }

    public function chiTietSanPham(string $id, string $danh_muc_id)
    {
        $sanPham = SanPham::query()->findOrFail($id);
        $danhMuc = DanhMuc::query()->findOrFail($danh_muc_id);
        $sanPhamsCungDanhMuc = $danhMuc->sanPhams;
        $comment = Comment::where('san_pham_id', '=', $sanPham->id)->latest('id')->get();
        $count_comment = 0; 

        foreach ($comment as $comment_count) {
            if ($comment_count) {
                $count_comment += 1; 
            }
        }
        // dd($comment);
        // dd($sanPhamsCungDanhMuc);
        return view('views.sanphams.chiTietSanPham', compact('sanPham', 'sanPhamsCungDanhMuc', 'comment', 'count_comment'));
    }
    // danh mục sản phẩm
    public function cate(string $id)
    {
        $danhMucTong = DanhMuc::query()->where('trang_thai', '=', '1')->get();

        $danhMuc = DanhMuc::query()->findOrFail($id);

        $sanPhamsCungDanhMuc = $danhMuc->sanPhams;
        // dd($danhMucTong);
        return view('views.sanphams.danhMuc', compact('danhMucTong', 'danhMuc', 'sanPhamsCungDanhMuc'));

    }
    // tìm kiếm sản phẩm
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        // dd($keyword);
        $sanPhams = SanPham::query();
        if ($keyword) {
            $sanPhams->where('ten_san_pham', 'like', "%{$keyword}%");
                // ->orWhere('mo_ta_ngan', 'like', "%{$keyword}%");
        }
        $sanPhams = $sanPhams->get();
        //    dd($sanPhams);
        return view('views.sanphams.search', compact('sanPhams'));
    }

    // bình luận 
    public function postComment(Request $request, string $san_pham_id)
    {
        $data = $request->all('comment');
        $data['san_pham_id'] = $san_pham_id;
        $data['user_id'] = auth()->id();
        if (Comment::create($data)) {
            return redirect()->back()->with('success', 'thêm comment thành công ');
        } else {
            return redirect()->back()->with('error', 'thêm comment không thành công ');
        }

    }

    // tạo form liên hệ 
    public function contact()
    {

        return view('views.contact');
    }
    public function senMail(Request $request)
    {
        dd($request->all());
        $email = $request->input('email');
        $name = $request->input('name');
        $phone = $request->input('phone');
        $noidung = $request->input('noidung');
    
        try {
            // Gửi email
            Mail::to($email)->send(new ContactEmail($email, $name, $phone, $noidung));
    
            // Chuyển hướng và thông báo thành công
            return redirect()->route('trangChu');
        } catch (\Exception $e) {
            // Xử lý lỗi nếu gửi email không thành công
            return redirect()->route('trangChu');
        }
    }



}
