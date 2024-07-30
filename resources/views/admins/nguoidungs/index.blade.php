@extends('layouts.admin')
@section('title')
    Người dùng
@endsection
@section('content')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title align-content-center mb-0">Người dùng </h5>
                <a href="{{ route('admins.nguoidungs.create') }}" class="btn btn-success">Người dùng </a>
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
                                    <th scope="col">Name</th>
                                    <th scope="col">email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">pasword</th>
                                    <th scope="col">is_active</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nguoiDung as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>

                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{!! $item->role == 'Admin'
                                            ? '<span class="badge rounded-pill text-bg-info">Admin</span>'
                                            : '<span class="badge rounded-pill text-bg-success">User</span>' !!}</td>
                                       <td>
                                        @if (Hash::needsRehash($item->password))
                                            <span class="badge rounded-pill text-bg-warning">Chưa mã hóa mật khẩu</span>
                                        @else
                                            <span class="badge rounded-pill text-bg-success">Đã mã hóa mật khẩu</span>
                                        @endif
                                    </td>

                                        <td>
                                            {!! $item->is_active == 1
                                                ? '<span class="badge rounded-pill text-bg-primary">không bị khóa</span>'
                                                : '<span class="badge rounded-pill text-bg-danger">Đã bị khóa</span>' !!}
                                        </td>
                                        <td>
                                            <a href="{{ route('admins.nguoidungs.edit', $item->id) }}"><i
                                                    class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i></a>
                                            <form action="{{ route('admins.nguoidungs.destroy', $item->id) }}" method="post"
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
