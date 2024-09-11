<div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
</div>
@extends('layouts.admin')
@section('title')
    danh sách khuyến mại
@endsection
@section('content')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title align-content-center mb-0">Danh sách khuyến mại</h5>
                <a href="{{ route('admins.khuyenmais.create') }}" class="btn btn-success">Thêm khuyến mại</a>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">

                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Mã khuyến mại</th>
                                    <th scope="col">Giá tiền hay % khuyến mại</th>
                                    <th scope="col">Trạng thái khuyến mại là % hay giá</th>
                                    <th scope="col">Ngày bắt đầu </th>
                                    <th scope="col">Ngày kết thúc</th>
                                    <th scope="col">Giới hạn người sử dụng</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Hành động</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listKhuyenMai as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->code }}</td>
                                        <td>  
                                        @if ($item->discount_type == $DISCOUNT_Percentage)
                                        {{$item->discount }} %
                                        @else
                                        {{number_format($item->discount)}}
                                        @endif
                                        </td>
                                        <td>
                                            {!! $item->discount_type == $DISCOUNT_Percentage
                                                ? '<span class="badge rounded-pill text-bg-primary">%</span>'
                                                : '<span class="badge rounded-pill text-bg-danger">Giá</span>' !!}
                                        </td>
                                        <td>{{ $item->start_date }}</td>
                                        <td>{{ $item->end_date }}</td>
                                        <td>{{ $item->usage_limit }}</td>
                                        <td> {!! $item->status == $STATUS_Active
                                            ? '<span class="badge rounded-pill text-bg-primary">Active</span>'
                                            : '<span class="badge rounded-pill text-bg-danger">In Active</span>' !!}</td>

                                        <td>
                                            <a href="{{ route('admins.khuyenmais.edit', $item->id) }}"><i
                                                    class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                            <form action="{{ route('admins.khuyenmais.destroy', $item->id) }}"
                                                method="post" class="d-inline "
                                                onsubmit="return confirm('bạn có muốn xóa không ?')">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="border-0 bg-white"><i
                                                        class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i></button>
                                            </form>
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
@endsection
