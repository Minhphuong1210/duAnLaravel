@extends('layouts.client')
@section('title')
    {{ $sanPham->ten_san_pham }}
@endsection
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('trangChu') }}"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('trangChu') }}">shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">group product</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding pb-0">
        <div class="container">
            <div class="row">
                <!-- product details wrapper start -->
                <div class="col-lg-12 order-1 order-lg-2">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider">
                                    <div class="pro-large-img img-zoom">
                                        <img src="{{ Storage::url($sanPham->hinh_anh_san_pham) }}" alt="product-details" />
                                    </div>
                                    @foreach ($sanPham->hinhAnhSanPham as $item)
                                        <div class="pro-large-img img-zoom">
                                            <img src="{{ Storage::url($item->hinh_anh) }}" alt="product-details" />
                                        </div>
                                    @endforeach
                                </div>
                                <div class="pro-nav slick-row-10 slick-arrow-style">
                                    <div class="pro-nav-thumb">
                                        <img src="{{ Storage::url($sanPham->hinh_anh_san_pham) }}" alt="product-details" />
                                    </div>
                                    @foreach ($sanPham->hinhAnhSanPham as $item)
                                        <div class="pro-nav-thumb">
                                            <img src="{{ Storage::url($item->hinh_anh) }}" alt="product-details" />
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="product-details-des">
                                    <div class="manufacturer-name">
                                        <a
                                            href="/product/detail/{{ $sanPham->id }}/{{ $sanPham->danh_muc_id }}">{{ $sanPham->ma_san_pham }}</a>
                                    </div>
                                    <h3 class="product-name">{{ $sanPham->ten_san_pham }}</h3>
                                    <div class="ratings d-flex">
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <div class="pro-review">
                                            <span>{{ $sanPham->luot_xem }} Lượt xem</span>
                                        </div>
                                    </div>
                                    <div class="price-box">
                                        @if (isset($sanPham->gia_khuyen_mai) && $sanPham->gia_khuyen_mai > 0)
                                            <span
                                                class="price-regular">{{ number_format($sanPham->gia_khuyen_mai, 0, '', '.') }}
                                                đ</span> <span
                                                class="price-old"><del>{{ number_format($sanPham->gia_san_pham) }}
                                                    đ</del></span>
                                        @else
                                            <span class="price-old">{{ number_format($sanPham->gia_san_pham) }} đ</span>
                                        @endif
                                    </div>

                                    <div class="availability">
                                        <i class="fa fa-check-circle"></i>
                                        <span>{{ $sanPham->so_luong }} in stock</span>
                                    </div>
                                    <p class="pro-desc">{{ $sanPham->mo_ta_ngan }}</p>
                                    <form action="{{ route('cart.addCart') }}" method="post">
                                        @csrf
                                        <div class="quantity-cart-box d-flex align-items-center">
                                            <h6 class="option-title">qty:</h6>
                                            <div class="quantity">
                                                <div class="pro-qty"><input type="text" value="1" id="quantityInput"
                                                        name="quantity"></div>
                                                <input type="hidden" name="product_id" value="{{ $sanPham->id }}">
                                            </div>
                                            <input type="hidden" name="danh_muc_id" value="{{ $sanPham->danh_muc_id }}">
                                            <div class="action_link">
                                                <button class="btn btn-cart2" type="submit">Add to cart</button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="useful-links">
                                        <a href="#" data-bs-toggle="tooltip" title="Compare"><i
                                                class="pe-7s-refresh-2"></i>compare</a>
                                        <a href="#" data-bs-toggle="tooltip" title="Wishlist"><i
                                                class="pe-7s-like"></i>wishlist</a>
                                    </div>
                                    <div class="like-icon">
                                        <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                        <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                        <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                        <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details inner end -->

                    <!-- product details reviews start -->
                    <div class="product-details-reviews section-padding pb-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-review-info">
                                    <ul class="nav review-tab">
                                        <li>
                                            <a class="active" data-bs-toggle="tab" href="#tab_one">description</a>
                                        </li>

                                        <li>
                                            <a data-bs-toggle="tab" href="#tab_three">reviews
                                                @if (Auth::check())
                                                    ({{ $count_comment }})
                                                @endif


                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content reviews-tab">


                                        @if (Auth::check())
                                            <div class="tab-pane fade" id="tab_three">

                                                @if (session('success'))
                                                    <div class="alert alert-success">
                                                        {{ session('success') }}
                                                    </div>
                                                @endif

                                                @if (session('error'))
                                                    <div class="alert alert-success">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif
                                                <form action="{{ route('comment', ['san_pham_id' => $sanPham->id]) }}"
                                                    class="review-form" method="POST">


                                                    @csrf
                                                    <h5>{{ $count_comment }} review for <span>
                                                            {{ $sanPham->ten_san_pham }}</span></h5>
                                                    <div class="total-reviews">

                                                        @foreach ($comment as $item)
                                                            <div class="review-box">
                                                                <div class="post-author">
                                                                    <p><span>{{ $item->user->name }}</span> Ngày
                                                                        {{ $item->created_at->format('d/mY') }}</p>
                                                                </div>
                                                                <p>{{ $item->comment }}</p>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col">
                                                            <label class="col-form-label"><span
                                                                    class="text-danger">*</span>
                                                                Your Name</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ Auth::user()->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col">
                                                            <label class="col-form-label"><span
                                                                    class="text-danger">*</span>
                                                                Your Email</label>
                                                            <input type="email" class="form-control" required
                                                                value=" {{ Auth::user()->email }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col">
                                                            <label class="col-form-label"><span
                                                                    class="text-danger">*</span>
                                                                Your Review</label>
                                                            <textarea class="form-control" required name="comment"></textarea>
                                                            <div class="help-block pt-10"><span
                                                                    class="text-danger">Note:</span>
                                                                HTML is not translated!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="buttons">
                                                        <button class="btn btn-sqr" type="submit">Continue</button>
                                                    </div>
                                                </form> <!-- end of review-form -->
                                            </div>
                                        @else
                                            <div class="alert alert_danger">
                                                <p>Đăng nhập để được bình luận và đọc những bình luận đẹp</p> click vào đây
                                                để đăng nhập <a href="{{ route('login') }}">Đăng nhập</a>
                                            </div>
                                        @endif

                                        <hr>
                                        <div class="tab-pane fade show active" id="tab_one">
                                            <div class="tab-one">
                                                <p>{!! $sanPham->mo_ta_anh !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details reviews end -->
                </div>
                <!-- product details wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->

    <!-- related products area start -->
    <section class="related-products section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Related Products</h2>
                        <p class="sub-title">Add related products to weekly lineup</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                        <!-- product item start -->
                        @foreach ($sanPhamsCungDanhMuc as $item)
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="/product/detail/{{ $item->id }}/{{ $item->danh_muc_id }}">
                                        <img class="pri-img" src="{{ Storage::url($item->hinh_anh_san_pham) }}"
                                            alt="product">
                                        <img class="sec-img" src="{{ Storage::url($item->hinh_anh_san_pham) }}"
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
                                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                                        <input type="hidden" name="danh_muc_id" value="{{ $item->danh_muc_id }}">
                                        <div class="cart-hover">
                                            <button class="btn btn-cart2" type="submit">Add to cart</button>
                                        </div>
                                    </form>

                                    </form>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a
                                                href="/product/detail/{{ $item->id }}/{{ $item->danh_muc_id }}">{{ $item->danhMuc->ten_danh_muc }}</a>
                                        </p>
                                    </div>
                                    <h6 class="product-name">
                                        <a
                                            href="/product/detail/{{ $item->id }}/{{ $item->danh_muc_id }}">{{ $item->ten_san_pham }}</a>
                                    </h6>
                                    <div class="price-box">
                                        @if (isset($item->gia_khuyen_mai) && $item->gia_khuyen_mai > 0)
                                            <span
                                                class="price-regular">{{ number_format($item->gia_khuyen_mai, 0, '', '.') }}
                                                đ</span> <span
                                                class="price-old"><del>{{ number_format($item->gia_san_pham) }}
                                                    đ</del></span>
                                        @else
                                            <span class="price-old">{{ number_format($item->gia_san_pham) }} đ</span>
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
    <!-- related products area end -->
@endsection


@section('js')
    <script>
        $('.pro-qty').prepend('<span class="dec qtybtn">-</span>');
        $('.pro-qty').append('<span class="inc qtybtn">+</span>');
        $('.qtybtn').on('click', function() {
            var $button = $(this);
            var $input = $button.parent().find('input')
            var oldValue = parseFloat($input.val());
            if ($button.hasClass('inc')) {
                var newVal = oldValue + 1;
            } else {
                if (oldValue > 1) {
                    var newVal = oldValue - 1;
                } else {
                    var newVal = 1;
                }
            }
            $input.val(newVal);
        });

        // nếu người dùng nhập số âm 
        $('#quantityInput').on('change', function() {
            var value = parseInt($(this).val(), 10);
            if (isNaN(value) || value < 1) {
                alert('số phải lớn hơn 1');
                $(this).val(1);
            }
        });
    </script>
@endsection
