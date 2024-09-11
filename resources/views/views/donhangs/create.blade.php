@extends('layouts.client')
@section('title')
    Đơn hàng
@endsection
@section('css')
@endsection
@section('content')
    <div class="checkout-page-wrapper section-padding">
        <div class="container">
            <form action="{{ route('donhangs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Checkout Billing Details -->
                    <div class="col-lg-6">
                        <div class="checkout-billing-details-wrap">
                            <h5 class="checkout-title">Billing Details</h5>
                            <div class="billing-form-wrap">

                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="f_name" class="required">Tên người nhận</label>
                                            <input type="text" id="f_name" placeholder="First Name" required
                                                name="ten_nguoi_nhan" value="{{ Auth::user()->name }}" />
                                        </div>
                                    </div>
                                    @error('ten_nguoi_nhan')
                                        <p class="alert alet-danger">{{ $message }}</p>
                                    @enderror
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="l_name" class="required">Email</label>
                                            <input type="text" id="l_name" placeholder="email" required name="email" value="{{ Auth::user()->email }}" />
                                        </div>
                                    </div>
                                </div>
                                @error('email')
                                    <p class="alert alet-danger">{{ $message }}</p>
                                @enderror


                                <div class="single-input-item">
                                    <label for="com-name">Số điện thoại</label>
                                    <input type="text" id="com-name" placeholder="Số điện thoại" name="sđt"
                                        value="{{ Auth::user()->phone ?? '' }}" />
                                </div>
                                @error('sđt')
                                    <p class="alert alet-danger">{{ $message }}</p>
                                @enderror


                                <div class="single-input-item">
                                    <label for="street-address" class="required mt-20">Địa chỉ</label>
                                    <input type="text" id="street-address" placeholder="Street address Line 1" required
                                        name="dia_chi" value="{{ Auth::user()->address ?? '' }}" />
                                </div>
                                @error('dia_chi')
                                    <p class="alert alet-danger">{{ $message }}</p>
                                @enderror
                                <div class="single-input-item">
                                    <label for="ordernote">Order Note</label>
                                    <textarea name="ghi_chu" id="ghi_chu" cols="30" rows="3"
                                        placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Details -->
                    <div class="col-lg-6">
                        <div class="order-summary-details">
                            <h5 class="checkout-title">Your Order Summary</h5>
                            <div class="order-summary-content">
                                <!-- Order Summary Table -->
                                <div class="order-summary-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Products</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart as $key => $item)
                                                <tr>
                                                    <td><a
                                                            href="{{ route('chiTietSanPham', ['id' => $key, 'danh_muc_id' => $item['danh_muc_id']]) }}">{{ $item['ten_san_pham'] }}<strong>
                                                                × {{ $item['so_luong'] }}</strong></a>
                                                    </td>
                                                    <td>{{ numBer_format($item['gia'] * $item['so_luong']) }} đ</td>
                                                    <td><input type="hidden" name="promotion_id" value="{{$promotion_id}}"></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Sub Total</td>
                                                <td><strong>{{ numBer_format($subTotal) }} đ</strong></td>
                                                <input type="hidden" name="tien_hang" value="{{ $subTotal }}">
                                            </tr>
                                            <tr>
                                                <td>Tiền Khuyến mại nếu có</td>
                                                <td><strong>{{numBer_format($Promotion_code) }} đ</strong></td>
                                                <input type="hidden" name="" value="{{ $Promotion_code }}">
                                            </tr>
                                            <tr>
                                                <td>Shipping</td>
                                                <td class="d-flex justify-content-center">
                                                    <ul class="shipping-type">
                                                        <li>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="flatrate" 
                                                                    class="custom-control-input" checked />
                                                                <label class="custom-control-label" for="flatrate">Flat
                                                                    Rate: {{ numBer_format($shipping) }} đ</label>
                                                            </div>
                                                            <input type="hidden" name="tien_ship"
                                                                value="{{ $shipping }}">
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="freeshipping" name="shipping"
                                                                    class="custom-control-input" />
                                                                <label class="custom-control-label" for="freeshipping">Free
                                                                    Shipping</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total Amount</td>
                                                <td><b>{{ numBer_format($total) }}</b></td>
                                                <input type="hidden" name="tong_tien" value="{{ $total }}">
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- Order Payment Method -->
                                <div class="order-payment-method">
                                    <div class="single-payment-method show">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cashon"  value="cash"
                                                    class="custom-control-input" checked />
                                                <label class="custom-control-label" for="cashon">Cash On Delivery</label>
                                            </div>
                                        </div>
                                        <div class="payment-method-details" data-method="cash">
                                            <p>Pay with cash upon delivery.</p>
                                        </div>
                                    </div>

                                    <div class="summary-footer-area">

                                        <button type="submit" class="btn btn-sqr">Place Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
@endsection
<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
</div>
