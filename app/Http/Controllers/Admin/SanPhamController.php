<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SanPhamRequest;
use App\Http\Requests\UpdateSanPhamRequest;
use App\Models\DanhMuc;
use App\Models\HinhAnhSanPham;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listSanPham = SanPham::orderByDesc('is_type')->get();
        // dd($listDanhMuc);
        return view('admins.sanphams.index', compact('listSanPham'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listDanhMuc = DanhMuc::query()->get();
        return view('admins.sanphams.create', compact('listDanhMuc'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SanPhamRequest $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->except('$_token');
            // chuyển đổi giá trị checkbox thành boolean

            $params['is_new'] = $request->has('is_new') ? 1 : 0;
            $params['is_hot'] = $request->has('is_hot') ? 1 : 0;
            $params['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
            $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;

            // xử lí hình ảnh đại diện 
            if ($request->hasFile('hinh_anh_san_pham')) {
                $params['hinh_anh_san_pham'] = $request->file('hinh_anh_san_pham')->store('uploads/sanphams', 'public');

            } else {
                $params['hinh_anh_san_pham'] = null;
            }
            // thêm sản phẩm
            $sanPham = SanPham::query()->create($params);
            // lấy Id sản phẩm
            $SanPhamID = $sanPham->id;
            if ($request->hasFile('list_hinh_anh')) {
                foreach ($request->file('list_hinh_anh') as $image) {
                    if ($image) {
                        $path = $image->store('uploads/hinhanhSanPham/id_' . $SanPhamID, 'public');
                        $sanPham->hinhAnhSanPham()->create([
                            'san_pham_id' => $SanPhamID,
                            'hinh_anh' => $path
                        ]);
                    }
                }
            }
            return redirect()->route('admins.sanphams.index')->with('success', 'thêm sản phẩm thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $listDanhMuc = DanhMuc::query()->get();
        $sanPham = SanPham::query()->findOrFail($id);
        return view('admins.sanphams.edit', compact('listDanhMuc', 'sanPham'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSanPhamRequest $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');
            // chuyển đổi giá trị checkbox thành boolean

            $params['is_new'] = $request->has('is_new') ? 1 : 0;
            $params['is_hot'] = $request->has('is_hot') ? 1 : 0;
            $params['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
            $params['is_show_home'] = $request->has('is_show_home') ? 1 : 0;


            $sanPham = SanPham::query()->findOrFail($id);
            if ($request->hasFile('hinh_anh_san_pham')) {
                if ($sanPham->hinh_anh_san_pham && Storage::disk('public')->exists($sanPham->hinh_anh_san_pham)) {
                    Storage::disk('public')->delete($sanPham->hinh_anh_san_pham);
                }
                $params['hinh_anh_san_pham'] = $request->file('hinh_anh_san_pham')->store('uploads/sanphams', 'public');

            } else {
                $sanPham['hinh_anh_san_pham'] = $sanPham->hinh_anh_san_pham;
            }

            // xử lí album 

            $currentImage = $sanPham->hinhAnhSanPham->pluck('id')->toArray();
            $arrCombine = array_combine($currentImage, $currentImage);
            // trường hợp xóa ảnh   
            foreach ($arrCombine as $key => $value) {
                // tìm kiếm id hình ảnh trong mảng ảnh ms đẩy lên 
                // nếu không tồn tại id tức là người dùng đã xóa hình ảnh đó 
                if (!array_key_exists($key, $request->list_hinh_anh)) {
                    $hinhAnhSanPham = HinhAnhSanPham::query()->find($key);
                    if ($hinhAnhSanPham && Storage::disk('public')->exists($hinhAnhSanPham->hinh_anh)) {
                        // xóa trong thư mục
                        Storage::disk('public')->delete($hinhAnhSanPham->hinh_anh);
                        // xóa trong cơ sở dữ liệu 
                        $hinhAnhSanPham->delete();
                    }
                }
            }
            // trường hợp thêm hoặc sửa 
            foreach ($request->list_hinh_anh as $key => $image) {
                if (!array_key_exists($key, $arrCombine)) {
                    if ($request->hasFile("list_hinh_anh.$key")) {
                        $path = $image->store('uploads/hinhanhSanPham/id_' . $id, 'public');
                        $sanPham->hinhAnhSanPham()->create([
                            'san_pham_id' => $id,
                            'hinh_anh' => $path,
                        ]);
                    }
                } else if (is_file($image) && $request->hasFile("list_hinh_anh.$key")) {
                    // trường hợp thay đổi hình ảnh 
                    $hinhAnhSanPham = HinhAnhSanPham::query()->find($key);
                    if ($hinhAnhSanPham && Storage::disk('public')->exists($hinhAnhSanPham)) {
                        Storage::disk('public')->delete($hinhAnhSanPham);
                    }
                    $path = $image->store('uploads/hinhanhSanPham/id_' . $id, 'public');
                    $hinhAnhSanPham->update([
                        'hinh_anh' => $path,
                    ]);
                }
            }

            $sanPham->update($params);
            return redirect()->route('admins.sanphams.index')->with('success', 'cập nhật thông tin  sản phẩm thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sanPham = SanPham::query()->findOrFail($id);
        // xóa hành ảnh đại diện sản phẩm
        if ($sanPham->hinh_anh_san_pham && Storage::disk('public')->exists($sanPham->hinh_anh_san_pham)) {
            Storage::disk('public')->delete($sanPham->hinh_anh_san_pham);
        }
        $sanPham->hinhAnhSanPham()->delete();
        // xóa toàn bộ hình ảnh trong thư mục
        $path = 'uploads/hinhanhSanPham/id_' . $id;
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->deleteDirectory($path);
        }
        // xóa sản phẩm 
        $sanPham->delete();
        return redirect()->route('admins.sanphams.index')->with('success', 'xóa sản phẩm thành công');
    }
}
