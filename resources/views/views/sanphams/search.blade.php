@extends('layouts.client')

@section('title')
@endsection

@section('content')
<div class="shop-main-wrapper section-padding">
    <div class="container">
        <div class="row">
            @if ($sanPhams->isEmpty())
                <p>Không tìm thấy sản phẩm bạn cần tìm</p>
            @else
                <div class="col-lg-12">
                    <div class="shop-product-wrapper">
                        <div class="shop-product-wrap list-view row mbn-30">
                            @foreach ($sanPhams as $key=>$item)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="product-item">
                                        <figure class="product-thumb">
                                            <a href="/product/detail/{{ $item->id }}/{{ $item->danh_muc_id }}">
                                                <img class="pri-img" src="{{ Storage::url($item->hinh_anh_san_pham) }}" alt="product">
                                                <img class="sec-img" src="{{ Storage::url($item->hinh_anh_san_pham) }}" alt="product">
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
                                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                <input type="hidden" name="danh_muc_id" value="{{ $item->danh_muc_id }}">
                                                <div class="cart-hover">
                                                    <button class="btn btn-cart2" type="submit">Add to cart</button>
                                                </div>
                                            </form>
                                        </figure>
                                        <div class="product-caption text-center">
                                            <div class="product-identity">
                                                <p class="manufacturer-name">
                                                    <a href="/product/detail/{{ $item->id }}/{{ $item->danh_muc_id }}">{{ $item->danhMuc->ten_danh_muc }}</a>
                                                </p>
                                            </div>
                                            <h6 class="product-name">
                                                <a href="/product/detail/{{ $item->id }}/{{ $item->danh_muc_id }}">{{ $item->ten_san_pham }}</a>
                                            </h6>
                                            <div class="price-box">
                                                @if (isset($item->gia_khuyen_mai) && $item->gia_khuyen_mai > 0)
                                                    <span class="price-regular">{{ number_format($item->gia_khuyen_mai, 0, '', '.') }} đ</span>
                                                    <span class="price-old"><del>{{ number_format($item->gia_san_pham) }} đ</del></span>
                                                @else
                                                    <span class="price-old">{{ number_format($item->gia_san_pham) }} đ</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="paginatoin-area text-center">
                            <ul class="pagination-box">
                                <li><a class="previous" href="#"><i class="pe-7s-angle-left"></i></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a class="next" href="#"><i class="pe-7s-angle-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
