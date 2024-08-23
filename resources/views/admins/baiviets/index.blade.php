<div>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
</div>

@extends('layouts.admin')
@section('title')
    Bài viết
@endsection
@section('content')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title align-content-center mb-0">Bài viết</h5>
                <a href="{{ route('admins.baiviets.create') }}" class="btn btn-success">Thêm vài viết</a>
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
                                    <th scope="col">Tiêu đề</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Nội dung</th>
                                    <th scope="col">Hành động</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($baiviet as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>

                                        <td>{{ $item->tieu_de }}</td>
                                        <td><img src="{{ Storage::url($item->hinh_anh) }}" alt="" width="150px">
                                        </td>
                                        <td>
                                            <textarea readonly style="width: 100%; height: 100px;">{{ $item->noi_dung }}</textarea>
                                        </td>
                                        <td>
                                            <a href="{{ route('admins.baiviets.edit', $item->id) }}"><i
                                                    class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                            <form action="{{ route('admins.baiviets.destroy', $item->id) }}" method="post"
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
