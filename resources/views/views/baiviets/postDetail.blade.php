<div>
    <!-- Simplicity is an acquired taste. - Katharine Gerould -->
</div>
@extends('layouts.client')
@section('title')
    Bài viết chi tiết
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
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="blog-left-sidebar.html">blog</a></li>
                                <li class="breadcrumb-item active" aria-current="page">blog details right sidebar</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- blog main wrapper start -->
    <div class="blog-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-2">
                    <aside class="blog-sidebar-wrapper">
                        <div class="blog-sidebar">
                            <h5 class="title">Các bài viết được xem nhiều nhất</h5>
                            <div class="recent-post">
                               @foreach ($posts_view as $posts_views)
                               <div class="recent-post-item">
                                <figure class="product-thumb">
                                    <a href="{{route('post.detail',$posts_views->id)}}">
                                        <img src="{{Storage::url($posts_views->hinh_anh)}}" alt="blog image">
                                    </a>
                                </figure>
                                <div class="recent-post-description">
                                    <div class="product-name">
                                        <h6><a href="{{route('post.detail',$posts_views->id)}}">{{$posts_views->tieu_de}}</a></h6>
                                        <p>{{ $posts_views->created_at->format('d-m-Y') }}</p>
                                    </div>
                                </div>
                            </div>
                               @endforeach
                             
                            </div>
                        </div> <!-- single sidebar end -->
                        <div class="blog-sidebar">
                            <h5 class="title">Danh mục sản phẩm</h5>
                            <ul class="blog-tags">
                            @foreach ($category as $categorys)
                            <li><a href="{{route('cate',$categorys->id)}}">{{$categorys->ten_danh_muc}}</a></li>
                            @endforeach
                                
                            </ul>
                        </div> <!-- single sidebar end -->
                    </aside>
                </div>
                <div class="col-lg-9 order-1">
                    <div class="blog-item-wrapper">
                        <!-- blog post item start -->
                        <div class="blog-post-item blog-details-post">
                            <figure class="blog-thumb">
                                <div class="blog-single-slide">
                                    <img src="{{ Storage::url($post->hinh_anh) }}" alt="blog image">
                                </div>
                            </figure>
                            <div class="blog-content">
                                <h3 class="blog-title">
                                    {{ $post->tieu_de }}
                                </h3>
                                <div class="blog-meta">
                                    <p>{{ $post->created_at->format('d-m-Y') }} | {{ $post->User->name }}
                                </div>
                                <div class="entry-summary">

                                    {!! $post->noi_dung !!}
                                  

                                    <div class="blog-share-link">
                                        <h6>Share :</h6>
                                        <div class="blog-social-icon">
                                            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                                            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                                            <a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a>
                                            <a href="#" class="google"><i class="fa fa-google-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- blog post item end -->




                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog main wrapper end -->
@endsection

@section('js')
@endsection
