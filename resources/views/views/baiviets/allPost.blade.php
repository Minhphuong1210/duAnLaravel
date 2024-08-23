<div>
    <!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
</div>
@extends('layouts.client')
@section('title')
    Về chúng tôi
@endsection
@section('content')
    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">blog no sidebar</li>
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
                    <div class="col-12">
                        <div class="blog-item-wrapper">
                            <!-- blog item wrapper end -->
                            <div class="row mbn-30">
                                @foreach ($post as $posts)
                                    <div class="col-md-6">
                                        <!-- blog post item start -->
                                        <div class="blog-post-item mb-30">
                                            <figure class="blog-thumb">
                                                <a href="blog-details.html">
                                                    <img src="{{ Storage::url($posts->hinh_anh) }}" alt="blog image">
                                                </a>
                                            </figure>
                                            <div class="blog-content">
                                                <div class="blog-meta">
                                                    <p>{{ $posts->created_at->format('d-m-Y') }} | {{ $posts->User->name }}
                                                    </p>
                                                </div>
                                                <h5 class="blog-title">
                                                    <a href="blog-details.html">{{ $posts->tieu_de }}</a>
                                                </h5>
                                            </div>
                                        </div>
                                        <!-- blog post item end -->
                                    </div>
                                @endforeach
                            </div>
                          
                            <!-- blog item wrapper end -->

                            <!-- start pagination area -->
                            <div class="paginatoin-area text-center">
                                <ul class="pagination-box">
                                    {{-- <li><a class="previous" href="#"><i class="pe-7s-angle-left"></i></a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a class="next" href="#"><i class="pe-7s-angle-right"></i></a></li> --}}
                                    <li>  {{$posts->link}}</li>
                                </ul>
                            </div>
                            <!-- end pagination area -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog main wrapper end -->
    </main>
@endsection
