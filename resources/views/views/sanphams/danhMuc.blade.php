@extends('layouts.client')
@section('title')
    {{ $danhMuc->ten_danh_muc }}
@endsection
@section('content')
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('trangChu') }}"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">shop</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <!-- sidebar area start -->
                <div class="col-lg-3 order-2 order-lg-1">
                    <aside class="sidebar-wrapper">
                        <!-- single sidebar start -->
                        <div class="sidebar-single">
                            <h5 class="sidebar-title">categories</h5>
                            <div class="sidebar-body">
                                <ul class="shop-categories">
                                    
                                    @foreach ($danhMucTong as $item)
                                   @php
                                        $soLuongSanPham = $item->sanPhams()->count();
                                   @endphp
                                    <li><a href="{{route('cate',['id'=>$item->id])}}">{{$item->ten_danh_muc}}
                                        <span> ({{$soLuongSanPham}}) </span>
                                    </a></li>
                                    @endforeach
                                    
                                </ul>
                            </div>
                        </div>
                        <!-- single sidebar end -->
{{-- lọc theo giá tiền  --}}
                        <!-- single sidebar start -->
                        <div class="sidebar-single">
                            <h5 class="sidebar-title">price</h5>
                            <div class="sidebar-body">
                                <div class="price-range-wrap">
                                    <div class="price-range" data-min="1" data-max="1000"></div>
                                    <div class="range-slider">
                                        <form action="#" class="d-flex align-items-center justify-content-between">
                                            <div class="price-input">
                                                <label for="amount">Price: </label>
                                                <input type="text" id="amount">
                                            </div>
                                            <button class="filter-btn">filter</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single sidebar end -->

       

                        <!-- single sidebar start -->
                        <div class="sidebar-banner">
                            <div class="img-container">
                                <a href="#">
                                    <img src="{{asset('assets/client/corano/assets/img/banner/sidebar-banner.jpg')}}" alt="">
                                </a>
                            </div>
                        </div>
                        <!-- single sidebar end -->
                    </aside>
                </div>
                <!-- sidebar area end -->
{{-- sản phẩm  --}}
                <!-- shop main wrapper start -->
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="shop-product-wrapper">
                        <!-- shop product top wrap start -->
                        <div class="shop-top-bar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                    <div class="top-bar-left">
                                        <div class="product-view-mode">
                                            <a class="active" href="#" data-target="grid-view"
                                                data-bs-toggle="tooltip" title="Grid View"><i class="fa fa-th"></i></a>
                                            <a href="#" data-target="list-view" data-bs-toggle="tooltip"
                                                title="List View"><i class="fa fa-list"></i></a>
                                        </div>
                                        <div class="product-amount">
                                            <p>Showing 1–16 of 21 results</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6 order-1 order-md-2">
                                    <div class="top-bar-right">
                                        <div class="product-short">
                                            <p>Sort By : </p>
                                            <select class="nice-select" name="sortby">
                                                <option value="trending">Relevance</option>
                                                <option value="sales">Name (A - Z)</option>
                                                <option value="sales">Name (Z - A)</option>
                                                <option value="rating">Price (Low &gt; High)</option>
                                                <option value="date">Rating (Lowest)</option>
                                                <option value="price-asc">Model (A - Z)</option>
                                                <option value="price-asc">Model (Z - A)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- shop product top wrap start -->

                        <!-- product item list wrapper start -->
                        <div class="shop-product-wrap grid-view row mbn-30">
                            <!-- product single item start -->
                            @foreach ($sanPhamsCungDanhMuc as $sanPhamsCungDanhMucs)
                            <div class="col-md-4 col-sm-6">
                                <!-- product grid start -->
                                <div class="product-item">
                                    <figure class="product-thumb">
                                        <a href="{{route('chiTietSanPham',['id'=>$sanPhamsCungDanhMucs->id,'danh_muc_id'=>$sanPhamsCungDanhMucs->danh_muc_id])}}">
                                            <img class="pri-img" src="{{Storage::url($sanPhamsCungDanhMucs->hinh_anh_san_pham)}}" alt="product">
                                            <img class="sec-img" src="{{Storage::url($sanPhamsCungDanhMucs->hinh_anh_san_pham)}}" alt="product">
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
                                            <input type="hidden" name="product_id" value="{{$sanPhamsCungDanhMucs->id}}">
                                            <input type="hidden" name="danh_muc_id" value="{{$sanPhamsCungDanhMucs->danh_muc_id }}">
                                            <div class="cart-hover">
                                                <button class="btn btn-cart2" type="submit">Add to cart</button>
                                            </div>
                                        </form>
                                    </figure>
                                    <div class="product-caption text-center">
                                        <div class="product-identity">
                                            <p class="manufacturer-name"><a href="{{route('chiTietSanPham',['id'=>$sanPhamsCungDanhMucs->id,'danh_muc_id'=>$sanPhamsCungDanhMucs->danh_muc_id])}}">{{$sanPhamsCungDanhMucs->danhMuc->ten_danh_muc}}</a></p>
                                        </div>
                                        <h6 class="product-name">
                                            <a href="{{route('chiTietSanPham',['id'=>$sanPhamsCungDanhMucs->id,'danh_muc_id'=>$sanPhamsCungDanhMucs->danh_muc_id])}}">{{$sanPhamsCungDanhMucs->ten_san_pham}}</a>
                                        </h6>
                                        <div class="price-box">
                                            @if (isset($sanPhamsCungDanhMucs->gia_khuyen_mai)&& $sanPhamsCungDanhMucs->gia_khuyen_mai > 0)
                                            <span class="price-regular">{{number_format($sanPhamsCungDanhMucs->gia_khuyen_mai)}} đ</span>  <span class="price-old"><del>{{number_format($sanPhamsCungDanhMucs->gia_san_pham)}} đ</del></span>
                                            
                                            @else
                                            <span class="price-old">{{number_format($sanPhamsCungDanhMucs->gia_san_pham)}} đ</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                               
                                <!-- product grid end -->

                                <!-- product list item end -->
                                <div class="product-list-item">
                                    <figure class="product-thumb">
                                        <a href="{{route('chiTietSanPham',['id'=>$sanPhamsCungDanhMucs->id,'danh_muc_id'=>$sanPhamsCungDanhMucs->danh_muc_id])}}">
                                            <img class="pri-img" src="{{Storage::url($sanPhamsCungDanhMucs->hinh_anh_san_pham)}}" alt="product">
                                            <img class="sec-img" src="{{Storage::url($sanPhamsCungDanhMucs->hinh_anh_san_pham)}}" alt="product">
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
                                            <input type="hidden" name="product_id" value="{{$sanPhamsCungDanhMucs->id}}">
                                            <input type="hidden" name="danh_muc_id" value="{{$sanPhamsCungDanhMucs->danh_muc_id }}">
                                            <div class="cart-hover">
                                                <button class="btn btn-cart2" type="submit">Add to cart</button>
                                            </div>
                                        </form>
                                    </figure>
                                    <div class="product-content-list">
                                        <div class="product-identity">
                                            <p class="manufacturer-name"><a href="{{route('chiTietSanPham',['id'=>$sanPhamsCungDanhMucs->id,'danh_muc_id'=>$sanPhamsCungDanhMucs->danh_muc_id])}}">{{$sanPhamsCungDanhMucs->danhMuc->ten_danh_muc}}</a></p>
                                        </div>
                                       
                                        <h6 class="product-name">
                                            <a href="{{route('chiTietSanPham',['id'=>$sanPhamsCungDanhMucs->id,'danh_muc_id'=>$sanPhamsCungDanhMucs->danh_muc_id])}}">{{$sanPhamsCungDanhMucs->ten_san_pham}}</a>
                                        </h6>
                                        <div class="price-box">
                                            @if (isset($sanPhamsCungDanhMucs->gia_khuyen_mai)&& $sanPhamsCungDanhMucs->gia_khuyen_mai > 0)
                                            <span class="price-regular">{{number_format($sanPhamsCungDanhMucs->gia_khuyen_mai)}} đ</span>  <span class="price-old"><del>{{number_format($sanPhamsCungDanhMucs->gia_san_pham)}} đ</del></span>
                                            
                                            @else
                                            <span class="price-old">{{number_format($sanPhamsCungDanhMucs->gia_san_pham)}} đ</span>
                                            @endif
                                        </div>
                                        <p>{{$sanPhamsCungDanhMucs->mo_ta_ngan}}</p>
                                    </div>
                                </div>
                                <!-- product list item end -->
                            </div>
                            @endforeach
                            <!-- product single item start -->


                        </div>
                        <!-- product item list wrapper end -->

                        <!-- start pagination area -->
                        <div class="paginatoin-area text-center">
                            <ul class="pagination-box">
                                <li><a class="previous" href="#"><i class="pe-7s-angle-left"></i></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a class="next" href="#"><i class="pe-7s-angle-right"></i></a></li>
                            </ul>
                        </div>
                        <!-- end pagination area -->
                    </div>
                </div>
                <!-- shop main wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->
@endsection
@section('js')
@endsection
