@extends('layouts.admin')
@section('title')
    Giao diện admin
@endsection
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Thông kê</h4>
                </div>
            </div>

            <!-- start row -->
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="row g-3">

                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-14 mb-1">Tổng sản phẩm</div>
                                    </div>

                                    <div class="d-flex align-items-baseline mb-2">
                                        <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $totalProduct }} sản phẩm
                                        </div>
                                        {{-- <div class="me-auto">
                                        <span class="text-primary d-inline-flex align-items-center">
                                            15%
                                            <i data-feather="trending-up" class="ms-1"
                                                style="height: 22px; width: 22px;"></i>
                                        </span>
                                    </div> --}}
                                    </div>
                                    {{-- <div id="website-visitors" class="apex-charts"></div> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-14 mb-1">Tổng số sản phẩm bán được</div>
                                    </div>

                                    <div class="d-flex align-items-baseline mb-2">
                                        <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ $totalOrder }} sản phẩm
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-14 mb-1">Tổng giá tiền thu về </div>
                                    </div>

                                    <div class="d-flex align-items-baseline mb-2">
                                        <div class="fs-22 mb-0 me-2 fw-semibold text-black">{{ number_format($totalPrice) }}
                                            VNĐ</div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="fs-14 mb-1">Active Users</div>
                                </div>

                                <div class="d-flex align-items-baseline mb-2">
                                    <div class="fs-22 mb-0 me-2 fw-semibold text-black">2,986</div>
                                    <div class="me-auto">
                                        <span class="text-success d-inline-flex align-items-center">
                                            4%
                                            <i data-feather="trending-up" class="ms-1"
                                                style="height: 22px; width: 22px;"></i>
                                        </span>
                                    </div>
                                </div>
                                <div id="active-users" class="apex-charts"></div>
                            </div>
                        </div>
                    </div> --}}
                    </div>
                </div> <!-- end sales -->
            </div> <!-- end row -->

            <!-- Start Monthly Sales -->
            <div class="row">
                <div class="col-md-6 col-xl-8">
                    <div class="card">

                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                    <i data-feather="bar-chart" class="widgets-icons"></i>
                                </div>
                                <h5 class="card-title mb-0 me-2">Thống kê sản phẩm theo tháng trong năm</h5>
                                <form action="{{ route('admins.thongkes.searchOfYear') }}" method="post"
                                    class="d-flex align-items-center">
                                    @csrf
                                    <div class="me-2">
                                        <input type="month" class="form-control" name="start_month" required>
                                    </div>
                                    <div class="me-2">
                                        <input type="month" class="form-control" name="end_month" required>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-light p-0 border-0">
                                            <i data-feather="search" class="widgets-icons"></i>
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="card-body">
                            <div id="monthly-sales" class="apex-charts"></div>
                        </div>

                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card overflow-hidden">

                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                    <i data-feather="tablet" class="widgets-icons"></i>
                                </div>
                                <h5 class="card-title mb-0">Bài viết được xem nhiều nhất</h5>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-traffic mb-0">
                                    <tbody>
                                        <thead>
                                            <tr>
                                                <th>Tên bài viết</th>
                                                <th colspan="2">Số lượng xem</th>
                                            </tr>
                                        </thead>

                                        @foreach ($posts_view as $posts_views)
                                            <tr>
                                                <td>{{ $posts_views->tieu_de }}</td>
                                                <td>{{ $posts_views->view }}</td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Monthly Sales -->

            <div class="row">
                <div class="col-md-6 col-xl-6">
                    <div class="card">

                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                        <i data-feather="minus-square" class="widgets-icons"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Sản Phẩm theo tuần</h5>
                                </div>

                                <form action="{{ route('admins.thongkes.thongKe') }}" method="post"
                                    class="d-flex align-items-center">
                                    @csrf
                                    <div class="me-2">
                                        <input type="date" class="form-control" name="start_date">
                                    </div>
                                    <div class="me-2">
                                        <input type="date" class="form-control" name="end_date">
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-light p-0 border-0">
                                            <i data-feather="search" class="widgets-icons"></i>
                                        </button>
                                    </div>
                                </form>

                            </div>

                        </div>

                        <div class="card-body">
                            <div id="audiences-daily" class="apex-charts mt-n3"></div>
                        </div>


                    </div>
                </div>

                <div class="col-md-6 col-xl-6">
                    <div class="card overflow-hidden">

                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                    <i data-feather="table" class="widgets-icons"></i>
                                </div>
                                <h5 class="card-title mb-0">Sản phẩm được xem nhiều nhất</h5>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-traffic mb-0">
                                    <tbody>

                                        <thead>
                                            <tr>
                                                <th>Tên sản phẩm</th>
                                                <th>Mã sản phẩm</th>
                                                <th>Hình ảnh sản phẩm</th>
                                                <th>Giá sản phẩm</th>
                                                <th>Số lượng sản phẩm</th>
                                                <th>Lượt xem sản phẩm</th>

                                            </tr>
                                        </thead>



                                        @foreach ($product_view as $product_views)
                                            <tr>

                                                <td>{{ $product_views->ten_san_pham }}</td>
                                                <td>{{ $product_views->ma_san_pham }}</td>
                                                <td>
                                                    <img src="{{ Storage::url($product_views->hinh_anh_san_pham) }}"
                                                        alt="" width="50px">
                                                </td>
                                                <td>
                                                    @if ($product_views->gia_khuyen_mai)
                                                        <span
                                                            class="price-regular">{{ number_format($product_views->gia_khuyen_mai) }}
                                                            đ</span> <span
                                                            class="price-old"><del>{{ number_format($product_views->gia_san_pham) }}
                                                                đ</del></span>
                                                    @else
                                                        <span
                                                            class="price-old">{{ number_format($product_views->gia_san_pham) }}
                                                            đ</span>
                                                    @endif
                                                </td>
                                                <td>{{ $product_views->so_luong }}</td>
                                                <td>{{ $product_views->luot_xem }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>




                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 col-xl-6">
                        <div class="card overflow-hidden">

                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                        <i data-feather="table" class="widgets-icons"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Top 5 Sản phẩm được bán nhiều nhất</h5>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-traffic mb-0">
                                        <tbody>

                                            <thead>
                                                <tr>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Mã sản phẩm</th>
                                                    <th>Hình ảnh sản phẩm</th>
                                                    <th>Giá sản phẩm</th>
                                                    <th>Tổng sản phẩm bán</th>
                                                    <th>Tổng giá tiền</th>

                                                </tr>
                                            </thead>



                                            @foreach ($product_bought as $product_boughts)
                                                <tr>

                                                    <td>{{ $product_boughts->sanPham->ten_san_pham }}</td>
                                                    <td>{{ $product_boughts->sanPham->ma_san_pham }}</td>
                                                    <td>
                                                        <img src="{{ Storage::url($product_boughts->sanPham->hinh_anh_san_pham) }}"
                                                            alt="" width="50px">
                                                    </td>
                                                    <td>
                                                        @if ($product_boughts->gia_khuyen_mai)
                                                            <span
                                                                class="price-regular">{{ number_format($product_boughts->sanPham->gia_khuyen_mai) }}
                                                            </span> <span
                                                                class="price-old"><del>{{ number_format($product_boughts->sanPham->gia_san_pham) }}
                                                                </del></span>
                                                        @else
                                                            <span
                                                                class="price-old">{{ number_format($product_boughts->sanPham->gia_san_pham) }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $product_boughts->tong_so_luong }}</td>
                                                    <td>{{ $product_boughts->don_gia * $product_boughts->tong_so_luong }}
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>




                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6">
                        <div class="card overflow-hidden">

                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                        <i data-feather="table" class="widgets-icons"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Top 5 Sản phẩm chưa được mua</h5>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-traffic mb-0">
                                        <tbody>

                                            <thead>
                                                <tr>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Mã sản phẩm</th>
                                                    <th>Hình ảnh sản phẩm</th>
                                                    <th>Giá sản phẩm</th>
                                                    <th>Tổng sản phẩm bán</th>
                                                    <th>Tổng giá tiền</th>

                                                </tr>
                                            </thead>



                                            @foreach ($product_not_boughts as $product_not_bought)
                                                <tr>

                                                    <td>{{ $product_not_bought->ten_san_pham }}</td>
                                                    <td>{{ $product_not_bought->ma_san_pham }}</td>
                                                    <td>
                                                        <img src="{{ Storage::url($product_not_bought->hinh_anh_san_pham) }}"
                                                            alt="" width="50px">
                                                    </td>
                                                    <td>
                                                        @if ($product_not_bought->gia_khuyen_mai)
                                                            <span
                                                                class="price-regular">{{ number_format($product_not_bought->gia_khuyen_mai) }}
                                                            </span> <span
                                                                class="price-old"><del>{{ number_format($product_not_bought->gia_san_pham) }}
                                                                </del></span>
                                                        @else
                                                            <span
                                                                class="price-old">{{ number_format($product_not_bought->gia_san_pham) }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $product_not_bought->tong_so_luong }}</td>
                                                    <td>{{ $product_not_bought->don_gia * $product_not_bought->tong_so_luong }}
                                                    </td>
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
@endsection
@section('js')
    <!-- Apexcharts JS -->
    <script>
        var options = {
            chart: {
                type: "bar",
                height: 307,
                parentHeightOffset: 0,
                toolbar: {
                    show: false
                },
            },
            colors: ["#537AEF"],
            series: [{
                name: 'Sản Phẩm',
                data: {!! json_encode($monthlySalesData) !!}
                // Đây là dữ liệu sản phẩm cho từng tháng trong năm
            }],
            fill: {
                opacity: 1,
            },
            plotOptions: {
                bar: {
                    columnWidth: "50%",
                    borderRadius: 4,
                    borderRadiusApplication: 'end', // 'around', 'end'
                    borderRadiusWhenStacked: 'last', // 'all', 'last'
                    dataLabels: {
                        position: 'top',
                        orientation: 'vertical',
                    }
                },
            },
            grid: {
                strokeDashArray: 4,
                padding: {
                    top: -20,
                    right: 0,
                    bottom: -4
                },
                xaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            xaxis: {
                type: 'category',
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                axisTicks: {
                    color: "#f0f4f7",
                },
            },
            yaxis: {
                title: {
                    text: 'Sản phẩm theo tháng',
                    style: {
                        fontSize: '12px',
                        fontWeight: 600,
                    }
                },
            },
            tooltip: {
                theme: 'light'
            },
            legend: {
                position: 'top',
                show: true,
                horizontalAlign: 'center',
            },
            stroke: {
                width: 0
            },
            dataLabels: {
                enabled: false,
            },
            theme: {
                mode: 'light'
            },
        };
        var chartOne = new ApexCharts(document.querySelector('#monthly-sales'), options);
        chartOne.render();
    </script>

    <script>
        var dataFromPHP = <?php echo $jsonData;
        ?>;

        var options = {
            series: dataFromPHP,
            chart: {
                height: 345,
                type: 'heatmap',
                parentHeightOffset: 0,
                toolbar: {
                    show: false
                },
            },
            plotOptions: {
                heatmap: {
                    radius: 10,
                    enableShades: true,
                    shadeIntensity: 2
                }
            },
            grid: {
                show: false,
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#537AEF"],
            legend: {
                show: true,
                position: "top",
                horizontalAlign: "center",
            },

        };
        var chart = new ApexCharts(document.querySelector("#audiences-daily"), options);
        chart.render();
    </script>
    <script src="{{ asset('assets/admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- for basic area chart -->
    <script src="{{ asset('assets/admin/assets/apexcharts.com/samples/assets/stock-prices.js') }}"></script>

    <!-- Widgets Init Js -->
    {{-- <script src="{{ asset('assets/admin/assets/js/pages/analytics-dashboard.init.js') }}"></script> --}}

    <!-- App js-->
    <script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
@endsection
