@extends('layouts.client')

@section('title')
@endsection

@section('content')




   <div class="container">
    <div class="shop-product-wrap grid-view row mbn-30">

        @if ($sanPhams->isEmpty())
            <p style="color:red;background:black">Không tìm thấy sản phẩm bạn cần tìm</p>
        @else
            @foreach ($sanPhams as $sanPhamsCungDanhMucs)
                <div class="col-md-4 col-sm-6">
                    <!-- product grid start -->
                    <div class="product-item">
                        <figure class="product-thumb">
                            <a
                                href="{{ route('chiTietSanPham', ['id' => $sanPhamsCungDanhMucs->id, 'danh_muc_id' => $sanPhamsCungDanhMucs->danh_muc_id]) }}">
                                <img class="pri-img" src="{{ Storage::url($sanPhamsCungDanhMucs->hinh_anh_san_pham) }}"
                                    alt="product">
                                <img class="sec-img" src="{{ Storage::url($sanPhamsCungDanhMucs->hinh_anh_san_pham) }}"
                                    alt="product">
                            </a>
                            <div class="product-badge">
                                <div class="product-label new">
                                    <span>new</span>
                                </div>
                                <div class="product-label discount">
                                    <span>10%</span>
                                </div>
                            </div>
                            <form action="{{ route('cart.addCart') }}" method="post">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="product_id" value="{{ $sanPhamsCungDanhMucs->id }}">
                                <input type="hidden" name="danh_muc_id" value="{{ $sanPhamsCungDanhMucs->danh_muc_id }}">
                                <div class="cart-hover">
                                    <button class="btn btn-cart2" type="submit">Add to cart</button>
                                </div>
                            </form>
                        </figure>
                        <div class="product-caption text-center">
                            <div class="product-identity">
                                <p class="manufacturer-name"><a
                                        href="{{ route('chiTietSanPham', ['id' => $sanPhamsCungDanhMucs->id, 'danh_muc_id' => $sanPhamsCungDanhMucs->danh_muc_id]) }}">{{ $sanPhamsCungDanhMucs->danhMuc->ten_danh_muc }}</a>
                                </p>
                            </div>
                            <h6 class="product-name">
                                <a
                                    href="{{ route('chiTietSanPham', ['id' => $sanPhamsCungDanhMucs->id, 'danh_muc_id' => $sanPhamsCungDanhMucs->danh_muc_id]) }}">{{ $sanPhamsCungDanhMucs->ten_san_pham }}</a>
                            </h6>
                            <div class="price-box">
                                @if (isset($sanPhamsCungDanhMucs->gia_khuyen_mai) && $sanPhamsCungDanhMucs->gia_khuyen_mai > 0)
                                    <span class="price-regular">{{ number_format($sanPhamsCungDanhMucs->gia_khuyen_mai) }}
                                        đ</span> <span
                                        class="price-old"><del>{{ number_format($sanPhamsCungDanhMucs->gia_san_pham) }}
                                            đ</del></span>
                                @else
                                    <span class="price-old">{{ number_format($sanPhamsCungDanhMucs->gia_san_pham) }}
                                        đ</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- product grid end -->

                    <!-- product list item end -->
                    <div class="product-list-item">
                        <figure class="product-thumb">
                            <a
                                href="{{ route('chiTietSanPham', ['id' => $sanPhamsCungDanhMucs->id, 'danh_muc_id' => $sanPhamsCungDanhMucs->danh_muc_id]) }}">
                                <img class="pri-img" src="{{ Storage::url($sanPhamsCungDanhMucs->hinh_anh_san_pham) }}"
                                    alt="product">
                                <img class="sec-img" src="{{ Storage::url($sanPhamsCungDanhMucs->hinh_anh_san_pham) }}"
                                    alt="product">
                            </a>
                            <div class="product-badge">
                                <div class="product-label new">
                                    <span>new</span>
                                </div>
                                <div class="product-label discount">
                                    <span>10%</span>
                                </div>
                            </div>

                            <form action="{{ route('cart.addCart') }}" method="post">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="product_id" value="{{ $sanPhamsCungDanhMucs->id }}">
                                <input type="hidden" name="danh_muc_id" value="{{ $sanPhamsCungDanhMucs->danh_muc_id }}">
                                <div class="cart-hover">
                                    <button class="btn btn-cart2" type="submit">Add to cart</button>
                                </div>
                            </form>
                        </figure>
                        <div class="product-content-list">
                            <div class="product-identity">
                                <p class="manufacturer-name"><a
                                        href="{{ route('chiTietSanPham', ['id' => $sanPhamsCungDanhMucs->id, 'danh_muc_id' => $sanPhamsCungDanhMucs->danh_muc_id]) }}">{{ $sanPhamsCungDanhMucs->danhMuc->ten_danh_muc }}</a>
                                </p>
                            </div>

                            <h6 class="product-name">
                                <a
                                    href="{{ route('chiTietSanPham', ['id' => $sanPhamsCungDanhMucs->id, 'danh_muc_id' => $sanPhamsCungDanhMucs->danh_muc_id]) }}">{{ $sanPhamsCungDanhMucs->ten_san_pham }}</a>
                            </h6>
                            <div class="price-box">
                                @if (isset($sanPhamsCungDanhMucs->gia_khuyen_mai) && $sanPhamsCungDanhMucs->gia_khuyen_mai > 0)
                                    <span class="price-regular">{{ number_format($sanPhamsCungDanhMucs->gia_khuyen_mai) }}
                                        đ</span> <span
                                        class="price-old"><del>{{ number_format($sanPhamsCungDanhMucs->gia_san_pham) }}
                                            đ</del></span>
                                @else
                                    <span class="price-old">{{ number_format($sanPhamsCungDanhMucs->gia_san_pham) }}
                                        đ</span>
                                @endif
                            </div>
                            <p>{{ $sanPhamsCungDanhMucs->mo_ta_ngan }}</p>
                        </div>
                    </div>
                    <!-- product list item end -->
                </div>
            @endforeach
        @endif
        <!-- product single item start -->


    </div>
   </div>
@endsection
