<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BaiViet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BaiVietController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $baiviet = BaiViet::query()->get();
        return view('admins.baiviets.index', compact('baiviet'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.baiviets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  dd($request->all());

        if ($request->isMethod('POST')) {
            $param = $request->except('_token');
            if ($request->hasFile('hinh_anh')) {
                $file = $request->file('hinh_anh')->store('uploads/baiviets', 'public');

            } else {
                $file = null;
            }
            $param['user_id'] = Auth::user()->id;
            $param['hinh_anh'] = $file;
            BaiViet::create($param);
            return redirect()->route('admins.baiviets.index')->with('success', 'thêm bài viết thành công');

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
        $baiviet = BaiViet::findOrFail($id);
        return view('admins.baiviets.edit', compact('baiviet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $baiviet = BaiViet::findOrFail($id);
        if ($request->isMethod('PUT')) {
            $param = $request->except('_token', '_method');
            if ($request->hasFile('hinh_anh')) {
                if ($baiviet->hinh_anh && Storage::disk('public')->exists($baiviet->hinh_anh)) {
                    Storage::disk('public')->delete($baiviet->hinh_anh);
                }
                $file = $request->file('hinh_anh')->store('uploads/baiviets', 'public');

            } else {
                $file = $baiviet->hinh_anh;
            }
            $param['user_id'] = Auth::user()->id;
            $param['hinh_anh'] = $file;
            $baiviet->update($param);
            return redirect()->route('admins.baiviets.index')->with('success', 'Sửa bài viết thành công');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd(123);
        $baiviet = BaiViet::findOrFail($id);

        if ($baiviet->hinh_anh && Storage::disk('public')->exists($baiviet->hinh_anh)) {
            Storage::disk('public')->delete($baiviet->hinh_anh);
        }
        $baiviet->delete();
        return redirect()->back()->with('success', 'xóa thành công');

    }
}
