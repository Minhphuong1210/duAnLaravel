<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\Promotions;
use App\Models\SanPham;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function listCart()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        $Promotion_code = 0;
        // $Promotion_id = null;
        $subTotal = 0;

        // Tính tổng phụ (subTotal) của giỏ hàng
        foreach ($cart as $item) {
            $itemPrice = isset($item['gia']) && is_numeric($item['gia']) ? floatval($item['gia']) : 0;
            $itemQuantity = isset($item['so_luong']) && is_numeric($item['so_luong']) ? floatval($item['so_luong']) : 0;
            $subTotal += $itemPrice * $itemQuantity;
        }

        // Phí vận chuyển cố định
        $shipping = 30000;

        // Lấy mã khuyến mãi từ yêu cầu
        // $codeFromRequest = $request->input('code', '');

        // // Xóa thông báo lỗi trước khi kiểm tra
        // session()->forget('error');
        // session()->forget('success');

        // if (!empty($codeFromRequest)) {
        //     $record = Promotions::where('code', $codeFromRequest)
        //         ->where('status', 'active')
        //         ->where('start_date', '<', Carbon::now())
        //         ->where('end_date', '>', Carbon::now())
        //         ->first();

        //     if ($record) {
        //         if ($record['discount_type'] == $DISCOUNT_Percentage) {
        //             $Promotion_code = $subTotal * $record['discount'] / 100;
        //         } else {
        //             $Promotion_code = $record['discount'];
        //         }
        //         $Promotion_id = $record['id'];
        //         session()->flash('success', 'Đã áp dụng mã khuyến mãi thành công.');
        //     } else {
        //         $Promotion_code = 0;
        //         session()->flash('error', 'Mã khuyến mãi không hợp lệ.');
        //     }
        // } else {
        //     $Promotion_code = 0;
        // }

        // Tính toán tổng
        $total = $subTotal + $shipping;
        $total = max($total, 0);

        // Trả về view với dữ liệu đã tính toán
        return view('views.cart.listCart', compact('cart', 'total', 'shipping', 'subTotal', 'Promotion_code'));
    }


    public function PromotionCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $DISCOUNT_Percentage = Promotions::DISCOUNT_Percentage;
        $subTotal = 0;
       
        foreach ($cart as $item) {
            $itemPrice = isset($item['gia']) && is_numeric($item['gia']) ? floatval($item['gia']) : 0;
            $itemQuantity = isset($item['so_luong']) && is_numeric($item['so_luong']) ? floatval($item['so_luong']) : 0;
            $subTotal += $itemPrice * $itemQuantity;
        }
        // Xử lý mã khuyến mãi
        $codeFromRequest = $request->input('code', '');
        // dd($codeFromRequest);
        $Promotion_code = 0;
        $Promotion_id = null;


        if (!empty($codeFromRequest)) {
            $record = Promotions::where('code', $codeFromRequest)
                ->where('status', 'active')
                ->where('start_date', '<', Carbon::now())
                ->where('end_date', '>', Carbon::now())
                ->where('usage_limit', '>', 0)
                ->first();
            // check xem người dùng đã sài mã hay chưa 
            $user_id = $request->user_id;
            $user = DonHang::query()
                ->where('user_id', $user_id)
                ->where('promotion_id', $record['id'])->first();

            if ($user) {
                return redirect()->back()->with('error', 'Mã khuyến mãi Người dùng đã sài');
            } else {
                
                if ($record) {
                    if ($record['discount_type'] == $DISCOUNT_Percentage) {
                        $Promotion_code = $subTotal * $record['discount'] / 100;
                    } else {
                        $Promotion_code = $record['discount'];
                    }
                    $Promotion_id = $record['id'];
                    session()->put('Promotion_code', $Promotion_code);
                    session()->put('Promotion_id', $Promotion_id);
                    return redirect()->back()->with('success', 'Đã áp dụng mã khuyến mãi thành công.');
                } else {
                    session()->put('Promotion_code', 0);
                    session()->put('Promotion_id', null);
                    return redirect()->back()->with('error', 'Mã khuyến mãi không hợp lệ.');
                }
              
            }

        } else {
            session()->put('Promotion_code', 0);
            session()->put('Promotion_id', null);
            return redirect()->back()->with('error', 'Mã khuyến mãi không được để trống.');
        }
    }


    public function addCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        $sanPham = SanPham::query()->findOrFail($product_id);
        // khởi tạo 1 mảng chứa thông tin giỏ hàng trên session 
        $cart = session()->get('cart', []);
        if (isset($cart[$product_id])){
            // sản phẩm đã có trong giỏ hàng 
            $cart[$product_id]['so_luong'] += $quantity;
        } else {
            // sản phẩm chưa có trong giỏ hàng 

            $cart[$product_id] = [
                'ten_san_pham' => $sanPham->ten_san_pham,
                'so_luong' => $quantity,
                'gia' => isset($sanPham->gia_khuyen_mai) ? $sanPham->gia_khuyen_mai : $sanPham->gia_san_pham,
                'hinh_anh_san_pham' => $sanPham->hinh_anh_san_pham,
                'danh_muc_id' => $sanPham->danh_muc_id,
            ];

        }
        session()->put('cart', $cart);
        //   dd( session()->put('cart',$cart));
        return redirect()->back();
    }
    public function updateCart(Request $request)
    {
        // dd($request->all());
        $cart = $request->input('cart', []);
        session()->put('cart', $cart);
        return redirect()->back();
    }
}
