<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function listCart()
    {
        // session()->put('cart',[]);
        $cart = session()->get('cart', []);
        $total = 0;
        $subTotal = 0;
        foreach ($cart as $item) {
            $subTotal += $item['gia'] * $item['so_luong'];
        }
        $shipping = 30000;
        $total = $subTotal + $shipping;
        return view('views.cart.listCart', compact('cart', 'total', 'shipping', 'subTotal'));
    }
    public function addCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        $sanPham = SanPham::query()->findOrFail($product_id);
        // khởi tạo 1 mảng chứa thông tin giỏ hàng trên session 
        $cart = session()->get('cart', []);
        if (isset($cart[$product_id])) {
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
