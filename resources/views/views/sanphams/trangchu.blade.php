@extends('layouts.client')

@section('title')
    Chu Minh Phương-Sell Engagement and Wedding Rings
@endsection
@section('css')
@endsection
@section('content')
    <!-- hero slider area start -->

    <section class="slider-area">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
            <!-- single slider item start -->
            @foreach ($danhMuc as $item)
                <div class="hero-single-slide hero-overlay">

                    <div class="hero-slider-item bg-img"
                        data-bg="{{ \Illuminate\Support\Facades\Storage::url($item->hinh_anh) }}">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="hero-slider-content slide-1">
                                        <h2 class="slide-title">{{ $item->ten_danh_muc }} </h2>
                                        <a href="/category/detail/{{ $item->id }}" class="btn btn-hero">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
    <!-- hero slider area end -->


{{-- không sửa  --}}
    <!-- service policy area start -->
    <div class="service-policy section-padding">
        <div class="container">
            <div class="row mtn-30">
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-plane"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Free Shipping</h6>
                            <p>Free shipping all order</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-help2"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Support 24/7</h6>
                            <p>Support 24 hours a day</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-back"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Money Return</h6>
                            <p>30 days for free return</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-credit"></i>
                        </div>
                        <div class="policy-content">
                            <h6>100% Payment Secure</h6>
                            <p>We ensure secure payment</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service policy area end -->

    <!-- banner statistics area start -->
 
    <!-- banner statistics area end -->
{{-- sửa --}}
    <!-- product area start -->
    <section class="product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">các sản phẩm mới ra </h2>
                        <p class="sub-title">Add our products to weekly lineup</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-container">
                      

                        <!-- product tab content start -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1">
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                    <!-- product item start -->
                                    @foreach ($sanPham_is_new as $sanPham_is_news)
                                    <div class="product-item">
                                        <figure class="product-thumb">
                                            <a href="/product/detail/{{$sanPham_is_news->id}}/{{$sanPham_is_news->danh_muc_id}}">
                                                <img class="pri-img"
                                                    src="{{ \Illuminate\Support\Facades\Storage::url($sanPham_is_news->hinh_anh_san_pham) }}"
                                                    alt="product">
                                                <img class="sec-img"
                                                    src="{{ \Illuminate\Support\Facades\Storage::url($sanPham_is_news->hinh_anh_san_pham) }}"
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
                                                <input type="hidden" name="product_id" value="{{$sanPham_is_news->id}}">
                                                <input type="hidden" name="danh_muc_id" value="{{$sanPham_is_news->danh_muc_id }}">
                                                <div class="cart-hover">
                                                    <button class="btn btn-cart2" type="submit">Add to cart</button>
                                                </div>
                                            </form>
                                        </figure>
                                        <div class="product-caption text-center">
                                            <div class="product-identity">
                                                <p class="manufacturer-name"><a href="/product/detail/{{$sanPham_is_news->id}}/{{$sanPham_is_news->danh_muc_id}}">{{$sanPham_is_news->ten_san_pham}}</a></p>
                                            </div>
                                            <div class="price-box">
                                               @if (isset($sanPham_is_news->gia_khuyen_mai)&& $sanPham_is_news->gia_khuyen_mai > 0)
                                               <span class="price-regular">{{number_format($sanPham_is_news->gia_khuyen_mai)}} đ</span>  <span class="price-old"><del>{{number_format($sanPham_is_news->gia_san_pham)}} đ</del></span>
                                               
                                               @else
                                               <span class="price-old">{{number_format($sanPham_is_news->gia_san_pham)}} đ</span>
                                               @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- product item end -->

                                </div>
                            </div>
                        </div>
                        <!-- product tab content end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product area end -->
{{-- không sửa --}}
    <!-- product banner statistics area start -->
    <section class="product-banner-statistics">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="product-banner-carousel slick-row-10">
                        <!-- banner single slide start -->
                        <div class="banner-slide-item">
                            <figure class="banner-statistics">
                                <a href="#">
                                    <img src="{{ asset('assets/client/corano/assets/img/banner/img1-middle.jpg') }}"
                                        alt="product banner">
                                </a>
                                <div class="banner-content banner-content_style2">
                                    <h5 class="banner-text3"><a href="#">BRACELATES</a></h5>
                                </div>
                            </figure>
                        </div>
                        <!-- banner single slide start -->
                        <!-- banner single slide start -->
                        <div class="banner-slide-item">
                            <figure class="banner-statistics">
                                <a href="#">
                                    <img src="{{ asset('assets/client/corano/assets/img/banner/img2-middle.jpg') }}"
                                        alt="product banner">
                                </a>
                                <div class="banner-content banner-content_style2">
                                    <h5 class="banner-text3"><a href="#">EARRINGS</a></h5>
                                </div>
                            </figure>
                        </div>
                        <!-- banner single slide start -->
                        <!-- banner single slide start -->
                        <div class="banner-slide-item">
                            <figure class="banner-statistics">
                                <a href="#">
                                    <img src="{{ asset('assets/client/corano/assets/img/banner/img3-middle.jpg') }}"
                                        alt="product banner">
                                </a>
                                <div class="banner-content banner-content_style2">
                                    <h5 class="banner-text3"><a href="#">NECJLACES</a></h5>
                                </div>
                            </figure>
                        </div>
                        <!-- banner single slide start -->
                        <!-- banner single slide start -->
                        <div class="banner-slide-item">
                            <figure class="banner-statistics">
                                <a href="#">
                                    <img src="{{ asset('assets/client/corano/assets/img/banner/img4-middle.jpg') }}"
                                        alt="product banner">
                                </a>
                                <div class="banner-content banner-content_style2">
                                    <h5 class="banner-text3"><a href="#">RINGS</a></h5>
                                </div>
                            </figure>
                        </div>
                        <!-- banner single slide start -->
                        <!-- banner single slide start -->
                        <div class="banner-slide-item">
                            <figure class="banner-statistics">
                                <a href="#">
                                    <img src="{{ asset('assets/client/corano/assets/img/banner/img5-middle.jpg') }}"
                                        alt="product banner">
                                </a>
                                <div class="banner-content banner-content_style2">
                                    <h5 class="banner-text3"><a href="#">PEARLS</a></h5>
                                </div>
                            </figure>
                        </div>
                        <!-- banner single slide start -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product banner statistics area end -->
{{-- sửa --}}
    <!-- featured product area start -->
    <section class="feature-product section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Các sản phẩm đang sale</h2>
                        <p class="sub-title">Add featured products to weekly lineup</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-carousel-4_2 slick-row-10 slick-arrow-style">
                        @foreach ($sanPham_is_hot_deal as $sanPham_is_hot_deals)
                        <div class="product-item">
                            <figure class="product-thumb">
                                <a href="/product/detail/{{$sanPham_is_hot_deals->id}}/{{$sanPham_is_hot_deals->danh_muc_id}}">
                                    <img class="pri-img"
                                        src="{{ \Illuminate\Support\Facades\Storage::url($sanPham_is_hot_deals->hinh_anh_san_pham) }}"
                                        alt="product">
                                    <img class="sec-img"
                                        src="{{ \Illuminate\Support\Facades\Storage::url($sanPham_is_hot_deals->hinh_anh_san_pham) }}"
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
                                    <input type="hidden" name="product_id" value="{{$sanPham_is_hot_deals->id}}">
                                    <input type="hidden" name="danh_muc_id" value="{{$sanPham_is_hot_deals->danh_muc_id }}">
                                    <div class="cart-hover">
                                        <button class="btn btn-cart2" type="submit">Add to cart</button>
                                    </div>
                                </form>
                            </figure>
                            <div class="product-caption text-center">
                                <div class="product-identity">
                                    <p class="manufacturer-name"><a href="/product/detail/{{$sanPham_is_hot_deals->id}}/{{$sanPham_is_hot_deals->danh_muc_id}}">{{$sanPham_is_hot_deals->ten_san_pham}}</a></p>
                                </div>
                                <div class="price-box">
                                    @if (isset($sanPham_is_hot_deals->gia_khuyen_mai)&& $sanPham_is_hot_deals->gia_khuyen_mai > 0)
                                   <span class="price-regular">{{number_format($sanPham_is_hot_deals->gia_khuyen_mai)}} đ</span>  <span class="price-old"><del>{{number_format($sanPham_is_hot_deals->gia_san_pham)}} đ</del></span>
                                   
                                   @else
                                   <span class="price-old">{{number_format($sanPham_is_hot_deals->gia_san_pham)}} đ</span>
                                   @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- product item end -->


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- featured product area end -->

    <!-- testimonial area start -->
    <section class="testimonial-area section-padding bg-img" data-bg="assets/img/testimonial/testimonials-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">testimonials</h2>
                        <p class="sub-title">What they say</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="testimonial-thumb-wrapper">
                        <div class="testimonial-thumb-carousel">
                            <div class="testimonial-thumb">
                                <img src="{{ asset('assets/client/corano/assets/img/testimonial/testimonial-1.png') }}"
                                    alt="testimonial-thumb">
                            </div>
                            <div class="testimonial-thumb">
                                <img src="{{ asset('assets/client/corano/assets/img/testimonial/testimonial-2.png') }}"
                                    alt="testimonial-thumb">
                            </div>
                            <div class="testimonial-thumb">
                                <img src="{{ asset('assets/client/corano/assets/img/testimonial/testimonial-3.png') }}"
                                    alt="testimonial-thumb">
                            </div>
                            <div class="testimonial-thumb">
                                <img src="{{ asset('assets/client/corano/assets/img/testimonial/testimonial-2.png') }}"
                                    alt="testimonial-thumb">
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-content-wrapper">
                        <div class="testimonial-content-carousel">
                            <div class="testimonial-content">
                                <p>Vivamus a lobortis ipsum, vel condimentum magna. Etiam id turpis tortor. Nunc
                                    scelerisque, nisi a blandit varius, nunc purus venenatis ligula, sed venenatis orci
                                    augue nec sapien. Cum sociis natoque</p>
                                <div class="ratings">
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                </div>
                                <h5 class="testimonial-author">lindsy niloms</h5>
                            </div>
                            <div class="testimonial-content">
                                <p>Vivamus a lobortis ipsum, vel condimentum magna. Etiam id turpis tortor. Nunc
                                    scelerisque, nisi a blandit varius, nunc purus venenatis ligula, sed venenatis orci
                                    augue nec sapien. Cum sociis natoque</p>
                                <div class="ratings">
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                </div>
                                <h5 class="testimonial-author">Daisy Millan</h5>
                            </div>
                            <div class="testimonial-content">
                                <p>Vivamus a lobortis ipsum, vel condimentum magna. Etiam id turpis tortor. Nunc
                                    scelerisque, nisi a blandit varius, nunc purus venenatis ligula, sed venenatis orci
                                    augue nec sapien. Cum sociis natoque</p>
                                <div class="ratings">
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                </div>
                                <h5 class="testimonial-author">Anamika lusy</h5>
                            </div>
                            <div class="testimonial-content">
                                <p>Vivamus a lobortis ipsum, vel condimentum magna. Etiam id turpis tortor. Nunc
                                    scelerisque, nisi a blandit varius, nunc purus venenatis ligula, sed venenatis orci
                                    augue nec sapien. Cum sociis natoque</p>
                                <div class="ratings">
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                </div>
                                <h5 class="testimonial-author">Maria Mora</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial area end -->

    <!-- group product start -->
    <section class="group-product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="group-product-banner">
                        <figure class="banner-statistics">
                            <a href="#">
                                <img src="{{ asset('assets/client/corano/assets/img/banner/img-bottom-banner.jpg') }}"
                                    alt="product banner">
                            </a>
                            <div class="banner-content banner-content_style3 text-center">
                                <h6 class="banner-text1">BEAUTIFUL</h6>
                                <h2 class="banner-text2">Wedding Rings</h2>
                                <a href="shop.html" class="btn btn-text">Shop Now</a>
                            </div>
                        </figure>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories-group-wrapper">
                        <!-- section title start -->
                        <div class="section-title-append">
                            <h4>Is_hot</h4>
                            <div class="slick-append"></div>
                        </div>
                        <!-- section title start -->

                        <!-- group list carousel start -->
                        <div class="group-list-item-wrapper">
                            <div class="group-list-carousel">
                                <!-- group list item start -->
                                @foreach ($sanPham_is_hot as $sanPham_is_hots)
                                <div class="group-slide-item">
                                    <div class="group-item">
                                        <div class="group-item-thumb">
                                            <a href="/product/detail/{{$sanPham_is_hots->id}}/{{$sanPham_is_hots->danh_muc_id}}">
                                                <img src="{{ \Illuminate\Support\Facades\Storage::url($sanPham_is_hots->hinh_anh_san_pham) }}"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="group-item-desc">
                                            <h5 class="group-product-name"><a href="/product/detail/{{$sanPham_is_hots->id}}/{{$sanPham_is_hots->danh_muc_id}}">
                                                    {{$sanPham_is_hots->ten_san_pham}}</a></h5>
                                            <div class="price-box">
                                                @if (isset($sanPham_is_hots->gia_khuyen_mai)&& $sanPham_is_hots->gia_khuyen_mai > 0)
                                                <span
                                                    class="price-regular">{{ number_format($sanPham_is_hots->gia_khuyen_mai) }}
                                                    đ</span> <span
                                                    class="price-old"><del>{{ number_format($sanPham_is_hots->gia_san_pham) }}
                                                        đ</del></span>
                                            @else
                                                <span
                                                    class="price-old">{{ number_format($sanPham_is_hots->gia_san_pham) }}
                                                    đ</span>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- group list item end -->

                               
                            </div>
                        </div>
                        <!-- group list carousel start -->
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories-group-wrapper">
                        <!-- section title start -->
                        <div class="section-title-append">
                            <h4>Is_show_home</h4>
                            <div class="slick-append"></div>
                        </div>
                        <!-- section title start -->

                        <!-- group list carousel start -->
                        <div class="group-list-item-wrapper">
                            <div class="group-list-carousel">
                                @foreach ($sanPham_is_show_home as $sanPham_is_show_homes)
                                <div class="group-slide-item">
                                    <div class="group-item">
                                        <div class="group-item-thumb">
                                            <a href="/product/detail/{{$sanPham_is_show_homes->id}}/{{$sanPham_is_show_homes->danh_muc_id}}">
                                                <img src="{{ \Illuminate\Support\Facades\Storage::url($sanPham_is_show_homes->hinh_anh_san_pham) }}"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="group-item-desc">
                                            <h5 class="group-product-name"><a href="/product/detail/{{$sanPham_is_show_homes->id}}/{{$sanPham_is_show_homes->danh_muc_id}}">
                                                    {{$sanPham_is_show_homes->ten_san_pham}}</a></h5>
                                            <div class="price-box">
                                                @if (isset($sanPham_is_show_homes->gia_khuyen_mai)&& $sanPham_is_show_homes->gia_khuyen_mai > 0)
                                                <span
                                                    class="price-regular">{{ number_format($sanPham_is_show_homes->gia_khuyen_mai) }}
                                                    đ</span> <span
                                                    class="price-old"><del>{{ number_format($sanPham_is_show_homes->gia_san_pham) }}
                                                        đ</del></span>
                                            @else
                                                <span
                                                    class="price-old">{{ number_format($sanPham_is_show_homes->gia_san_pham) }}
                                                    đ</span>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- group list carousel start -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- group product end -->

    <!-- latest blog area start -->
    <section class="latest-blog-area section-padding pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">News</h2>
                        <p class="sub-title">There are news posts</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="blog-carousel-active slick-row-10 slick-arrow-style">
                        <!-- blog post item start -->
                        <div class="blog-post-item">
                            <figure class="blog-thumb">
                                <a href="blog-details.html">
                                    <img src="{{ asset('assets/client/corano/assets/img/blog/blog-img1.jpg') }}"
                                        alt="blog image">
                                </a>
                            </figure>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <p>25/03/2019 | <a href="#">Corano</a></p>
                                </div>
                                <h5 class="blog-title">
                                    <a href="blog-details.html">Celebrity Daughter Opens Up About Having Her Eye Color
                                        Changed</a>
                                </h5>
                            </div>
                        </div>
                        <!-- blog post item end -->

                        <!-- blog post item start -->
                        <div class="blog-post-item">
                            <figure class="blog-thumb">
                                <a href="blog-details.html">
                                    <img src="{{ asset('assets/client/corano/assets/img/blog/blog-img2.jpg') }}"
                                        alt="blog image">
                                </a>
                            </figure>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <p>25/03/2019 | <a href="#">Corano</a></p>
                                </div>
                                <h5 class="blog-title">
                                    <a href="blog-details.html">Children Left Home Alone For 4 Days In TV series
                                        Experiment</a>
                                </h5>
                            </div>
                        </div>
                        <!-- blog post item end -->

                        <!-- blog post item start -->
                        <div class="blog-post-item">
                            <figure class="blog-thumb">
                                <a href="blog-details.html">
                                    <img src="{{ asset('assets/client/corano/assets/img/blog/blog-img3.jpg') }}"
                                        alt="blog image">
                                </a>
                            </figure>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <p>25/03/2019 | <a href="#">Corano</a></p>
                                </div>
                                <h5 class="blog-title">
                                    <a href="blog-details.html">Lotto Winner Offering Up Money To Any Man That Will Date
                                        Her</a>
                                </h5>
                            </div>
                        </div>
                        <!-- blog post item end -->

                        <!-- blog post item start -->
                        <div class="blog-post-item">
                            <figure class="blog-thumb">
                                <a href="blog-details.html">
                                    <img src="{{ asset('assets/client/corano/assets/img/blog/blog-img4.jpg') }}"
                                        alt="blog image">
                                </a>
                            </figure>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <p>25/03/2019 | <a href="#">Corano</a></p>
                                </div>
                                <h5 class="blog-title">
                                    <a href="blog-details.html">People are Willing Lie When Comes Money, According to
                                        Research</a>
                                </h5>
                            </div>
                        </div>
                        <!-- blog post item end -->

                        <!-- blog post item start -->
                        <div class="blog-post-item">
                            <figure class="blog-thumb">
                                <a href="blog-details.html">
                                    <img src="{{ asset('assets/client/corano/assets/img/blog/blog-img5.jpg') }}"
                                        alt="blog image">
                                </a>
                            </figure>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <p>25/03/2019 | <a href="#">Corano</a></p>
                                </div>
                                <h5 class="blog-title">
                                    <a href="blog-details.html">romantic Love Stories Of Hollywoodâ€™s Biggest
                                        Celebrities</a>
                                </h5>
                            </div>
                        </div>
                        <!-- blog post item end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- latest blog area end -->

    <!-- brand logo area start -->
    <div class="brand-logo section-padding pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="brand-logo-carousel slick-row-10 slick-arrow-style">
                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="{{ asset('assets/client/corano/assets/img/brand/1.png') }}" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="{{ asset('assets/client/corano/assets/img/brand/2.png') }}" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="{{ asset('assets/client/corano/assets/img/brand/3.png') }}" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="{{ asset('assets/client/corano/assets/img/brand/4.png') }}" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="{{ asset('assets/client/corano/assets/img/brand/5.png') }}" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="{{ asset('assets/client/corano/assets/img/brand/6.png') }}" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- brand logo area end -->
@endsection
@section('js')
@endsection
