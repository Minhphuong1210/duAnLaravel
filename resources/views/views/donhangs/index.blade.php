@extends('layouts.client')

@section('title')
    Đơn hàng
@endsection

@section('content')
    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('trangChu') }}"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('trangChu') }}">Shop</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">My Order</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

    <!-- Cart Main Wrapper Start -->
    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-12">
                        <!-- Cart Table Area -->
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày đặt</th>
                                        <th>Trạng thái</th>
                                        <th>Tổng tiền</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donHangs as $item)
                                        <tr>
                                            <td>
                                                <a href="{{ route('donhangs.show', $item->id) }}">
                                                    {{ $item->ma_don_hang }}
                                                </a>
                                            </td>
                                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $trangThaiDonHang[$item->trang_thai_don_hang] ?? 'Không xác định' }}</td>
                                            <td>{{ number_format($item->tong_tien) }} đ</td>
                                            <td>
                                                <a href="{{ route('donhangs.show', $item->id) }}" class="btn btn-sqr">
                                                    View
                                                </a>
                                                <form action="{{ route('donhangs.update', $item->id) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    @if ($item->trang_thai_don_hang === $type_cho_xac_nhan)
                                                        <input type="hidden" name="huy_don_hang" value="1">
                                                        <button type="submit" class="btn btn-sqr bg-danger" onclick="return confirm('Bạn có xác nhận hủy đơn hàng không?')">Hủy</button>
                                                    @elseif ($item->trang_thai_don_hang === $type_dang_van_chuyen)
                                                        <input type="hidden" name="da_nhan_hang" value="1">
                                                        <button type="submit" class="btn btn-sqr bg-success" onclick="return confirm('Bạn có xác nhận đã nhận hàng không?')">Đã nhận hàng</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Cart Update Option -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Main Wrapper End -->
@endsection
