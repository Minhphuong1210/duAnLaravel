@extends('layouts.client')
@section('title')
    Đơn hàng
@endsection
@section('content')
    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content" id="myaccountContent">
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                <div class="myaccount-content">
                                    <h5>Thông tin đơn hàng: <span>{{ $donHang->ma_don_hang }}</span> </h5>
                                    <div class="welcome">
                                        <p>Tên người nhận: <strong>{{ $donHang->ten_nguoi_nhan }} </strong> </p>
                                        <p>Email: <strong>{{ $donHang->email }} </strong> </p>
                                        <p>Số điện thoại: <strong>{{ $donHang->sđt }} </strong> </p>
                                        <p>Địa chỉ: <strong>{{ $donHang->dia_chi }} </strong> </p>
                                        <p>Ghi chú: <strong>{{ $donHang->ghi_chu ?? 'không có ghi chú của bạn' }} </strong>
                                        </p>
                                        <p>Trạng thái đơn hàng : <strong>{{ $donHang->trang_thai_don_hang }} </strong> </p>
                                        <p>Trạng thái thanh toán: <strong>{{ $donHang->trang_thai_thanh_toan }} </strong>
                                        </p>
                                        <p>Tiền hàng : <strong>{{ number_format($donHang->tien_hang) }} đ</strong> </p>
                                        <p>Tiền ship: <strong>{{ number_format($donHang->tien_ship) }} đ</strong> </p>
                                        <p>Tổng Tiền: <strong>{{ number_format($donHang->tong_tien) }} đ</strong> </p>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="tab-content" id="myaccountContent">
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                <div class="myaccount-content">

                                    <h5>Sản phẩm</h5>
                                    <div class="myaccount-table table-responsive text-center">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Hình ảnh sản phẩm</th>
                                                    <th>Mã sản phẩm</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Đơn giá </th>
                                                    <th>Số lượng</th>
                                                    <th>Thành tiền</th>
                                                    

                                                </tr>
                                            </thead>
                                            <tbody>
                                              @foreach ($donHang->chiTietDonHang as $item)
                                              @php
                                                  $sanPham = $item->sanPham;
                                              @endphp
                                              <tr>
                                                <td><img src="{{Storage::url($sanPham->hinh_anh_san_pham)}}" alt="" width="50px"></td>
                                                <td>{{$sanPham->ma_san_pham}}</td>
                                                <td>{{$sanPham->ten_san_pham}}</td>
                                                <td>{{number_format($item->don_gia)}}</td>
                                                <td>{{$item->so_luong}}</td>
                                                <td>{{number_format($item->thanh_tien)}}</td>
                                            </tr>
                                              @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection





<div>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
</div>
