@extends('layouts.admin')
@section('title')
    danh mục sản phẩm
@endsection
@section('content')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title align-content-center mb-0">Danh sách sản phẩm</h5>
                <a href="{{ route('admins.danhmucs.create') }}" class="btn btn-success">Thêm sản phẩm</a>
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
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Tên danh mục</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Hành động</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listDanhMuc as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td><img src="{{ Storage::url($item->hinh_anh) }}" alt="" width="150px">
                                        </td>
                                        <td>{{ $item->ten_danh_muc }}</td>
                                        <td>
                                            {!! $item->trang_thai == true
                                                ? '<span class="badge rounded-pill text-bg-primary">Hiện</span>'
                                                : '<span class="badge rounded-pill text-bg-danger">Ẩn</span>' !!}
                                        </td>
                                        <td>
                                            <a href="{{ route('admins.danhmucs.edit', $item->id) }}"><i
                                                    class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                            <form action="{{ route('admins.danhmucs.destroy', $item->id) }}" method="post"
                                                class="d-inline " onsubmit="return confirm('bạn có muốn xóa không ?')">
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
    @endsection
    @section('js')
    @endsection
