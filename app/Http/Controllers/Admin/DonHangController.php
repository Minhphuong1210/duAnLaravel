<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Illuminate\Http\Request;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listDonHang = DonHang::query()->orderByDesc('id')->get();
        // dd($listDonHang);
        $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;
        foreach ($trangThaiDonHang as $key => $value) {
            $key_trang_thai = $key;
            $value_trang_thai = $value;
        }


        return view('admins.donhangs.index', compact('listDonHang', 'trangThaiDonHang', 'key_trang_thai', 'value_trang_thai'));
    }

    /**
     * Show the form for creating a new resource.
     */
public function show(string $id){
    $donHang = DonHang::query()->findOrFail($id);
    $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;
    $trangThaiThanhToan = DonHang::TRANG_THAI_THANH_TOAN;
    return view('admins.donhangs.show',compact('donHang', 'trangThaiDonHang', 'trangThaiThanhToan'));
}




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $donHang = DonHang::query()->findOrFail($id);
        $currentTrangThai = $donHang->trang_thai_don_hang;
        // dd($currentTrangThai);
        $newTrangThai = $request->input('trang_thai_don_hang');
        $trangThais = array_keys(DonHang::TRANG_THAI_DON_HANG);
        // kiếm tra nếu đơn hàng đã bị hủy thì không được thay đổi trạng thái nữa
        if ($currentTrangThai == DonHang::HUY_HANG) {
            return redirect()->route('admins.donhangs.index')->with('error', 'đơn hàng đã bị hủy không thể thay đổi được trạng thái đơn hàng');
        }
        // kiểm tra nếu  trạng thái mới không được nằm sau trạng thái hiện tại
        if (array_search($newTrangThai, $trangThais) < array_search($currentTrangThai, $trangThais)) {
            return redirect()->route('admins.donhangs.index')->with('error', 'không thể cập nhật ngược lại trạng thái');
        }
        $donHang->trang_thai_don_hang = $newTrangThai;
        $donHang->save();
        return redirect()->route('admins.donhangs.index')->with('success', 'cập nhật trạng thái thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $donHang = DonHang::query()->findOrFail($id);

        if ($donHang && $donHang->trang_thai_don_hang == DonHang::HUY_HANG) {
            $donHang->chiTietDonHang->delete();
            $donHang->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        }else{
            return redirect()->back()->with('error', 'Không thể xóa đơn hàng');
        }
    }
}
