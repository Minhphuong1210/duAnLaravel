<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirm;
use App\Models\DonHang;
use App\Models\Promotions;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donHangs = Auth::user()->donHang()->orderBy('id', 'desc')->paginate(5);
        $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;
        // dd($trangThaiDonHang);
        $type_cho_xac_nhan = DonHang::CHO_XAC_NHA;
        $type_dang_van_chuyen = DonHang::DANG_VAN_CHUYEN;
        // dd($donHangs, $trangThaiDonHang, $type_cho_xac_nhan, $type_dang_van_chuyen);
        return view('views.donhangs.index', compact('donHangs', 'trangThaiDonHang', 'type_cho_xac_nhan', 'type_dang_van_chuyen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        session()->forget('Promotion_code');
        $DISCOUNT_Percentage = Promotions::DISCOUNT_Percentage;
        $cart = session()->get('cart', []);
        // dd($cart);
        if (!empty($cart)) {
            $total = 0;
            $subTotal = 0;
            $Promotion_code = 0;
            foreach ($cart as $item) {
                $subTotal += $item['gia'] * $item['so_luong'];
                $promotion_id = $item['promotion_id'];
            }
            $promotion = Promotions::query()->findOrFail($promotion_id);
            // dd($promotion_id);
            if ($promotion) {
                if ($promotion['discount_type'] == $DISCOUNT_Percentage) {
                    $Promotion_code = $subTotal * $promotion['discount'] / 100;
                } else {
                    $Promotion_code = $promotion['discount'];
                }

            }
            $shipping = 30000;
            $total = $subTotal + $shipping - $Promotion_code;
        }
        return view('views.donhangs.create', compact('cart', 'subTotal', 'Promotion_code', 'promotion_id', 'shipping', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        if ($request->isMethod('POST')) {
            DB::beginTransaction();
            try {
                $params = $request->except('_token');
                $params['ma_don_hang'] = $this->generateUniqueOrderCode();
                $params['trang_thai_don_hang'] = DonHang::CHO_XAC_NHA;
                $donHang = DonHang::create($params);
                $donHangId = $donHang->id;
                $promotion_id = $donHang->promotion_id;
                $carts = session()->get('cart', []);
                foreach ($carts as $key => $item) {
                    $thanhTien = $item['gia'] * $item['so_luong'];
                    $donHang->chiTietDonHang()->create([
                        'don_hang_id' => $donHangId,
                        'san_pham_id' => $key,
                        'don_gia' => $item['gia'],
                        'so_luong' => $item['so_luong'],
                        'thanh_tien' => $thanhTien,
                        'promotion_id' => $donHang->promotion_id,
                    ]);
                    // sau khi mua thành công thì đã trừ đi bớt sp ở sản phẩm
                    $sanPham = SanPham::query()->find($key);
                    if ($sanPham) {
                        $sanPham->so_luong -= $item['so_luong'];
                        $sanPham->save();
                    }
                    $Promotions = Promotions::query()->find($promotion_id);
                    if ($Promotions) {
                        $Promotions->usage_limit -= 1;
                        $Promotions->save();
                    }
                }

                DB::commit();
                // gửi mail khi đặt hành thành công
                Mail::to($donHang->email)->queue(new OrderConfirm($donHang));
                session()->put('cart', []);
                return redirect()->route('donhangs.index')->with('success', 'Đơn hàng đã được thêm thành công');
            } catch (\Exception $exception) {
                DB::rollBack();
                // cách log lỗi ra chi tiết nhất
                // \Log::error('Order creation error: ' . $exception->getMessage());


                return redirect()->route('cart.listCart')->with('error', 'Có lỗi khi tạo đơn hàng, vui lòng thử lại sau: ' . $exception->getMessage());
            }
        }

        return view('views.donhangs.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $donHang = DonHang::query()->findOrFail($id);
        $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;
        $trangThaiThanhToan = DonHang::TRANG_THAI_THANH_TOAN;
        return view('views.donhangs.show', compact('donHang', 'trangThaiDonHang', 'trangThaiThanhToan'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $donHang = DonHang::query()->findOrFail($id);
        // dd(DonHang::HUY_HANG);
        DB::beginTransaction();
        try {
            if ($request->has('huy_don_hang')) {
                $donHang->update(['trang_thai_don_hang' => DonHang::HUY_HANG]);
            } else if ($request->has('da_nhan_hang')) {
                $donHang->update(['trang_thai_don_hang' => DonHang::DA_NHAN_HANG]);
            }
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    function generateUniqueOrderCode()
    {
        do {
            $orderCode = 'ORD_' . Auth::id() . '_' . now()->timestamp;
        } while (DonHang::where('ma_don_hang', $orderCode)->exists());
        return $orderCode;
    }
}
