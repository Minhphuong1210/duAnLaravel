<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use App\Models\SanPham;
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
    public function show(string $id)
    {
        $donHang = DonHang::query()->findOrFail($id);
        $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;
        $trangThaiThanhToan = DonHang::TRANG_THAI_THANH_TOAN;
        return view('admins.donhangs.show', compact('donHang', 'trangThaiDonHang', 'trangThaiThanhToan'));
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

        if ($donHang->trang_thai_don_hang == DonHang::HUY_HANG) {

            // Lấy thông tin chi tiết đơn hàng trước khi xóa
            $chiTietDonHangs = $donHang->chiTietDonHang;

            // Xóa các chi tiết đơn hàng
            $donHang->chiTietDonHang()->delete();

            // Lặp qua từng chi tiết đơn hàng để trả lại số lượng về kho của sản phẩm
            foreach ($chiTietDonHangs as $chiTiet) {
                $sanPhamId = $chiTiet->san_pham_id;
                $soLuongHoanTra = $chiTiet->so_luong;

                // Tìm sản phẩm và cập nhật số lượng trong kho
                $sanPham = SanPham::query()->where('id', $sanPhamId)->first();
                if ($sanPham) {
                    $sanPham->so_luong += $soLuongHoanTra;
                    $sanPham->save();
                }
            }

            // Xóa đơn hàng
            $donHang->delete();

            return redirect()->back()->with('success', 'Xóa thành công');

        } else {
            return redirect()->back()->with('error', 'Không thể xóa đơn hàng');
        }
    }

}
