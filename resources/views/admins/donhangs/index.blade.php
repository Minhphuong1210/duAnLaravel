@extends('layouts.admin')
@section('title')
    danh sách đơn hàng
@endsection
@section('content')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title align-content-center mb-0">Danh sách đơn hàng </h5>

            </div>

            <div class="card-body">
                <div class="card-body">
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
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">

                            <thead>
                                <tr>
                                    <th scope="col">Mã sản phẩm</th>
                                    <th scope="col">Ngày đặt</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th>Thay đổi trạng thái đơn hàng </th>
                                    <th scope="col">Hành động</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listDonHang as $item)
                                    <tr>
                                        <th scope="row">{{ $item->ma_don_hang }}</th>


                                        <td>{{ $item->created_at->format('d-m-y') }}</td>
                                        <td>{{ $item->trang_thai_don_hang }}</td>
                                        <td>{{ number_format($item->tong_tien) }}</td>
                                        <td>

                                            <form action="{{ route('admins.donhangs.update', $item->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <select name="trang_thai_don_hang" class="form-select w-50"
                                                    onchange="confirmSubmit(this)"
                                                    data-default-value="{{ $item->trang_thai_don_hang }}">
                                                    @foreach ($trangThaiDonHang as $key => $value)
                                                        <option value="{{ $key }}"
                                                            {{ $item->trang_thai_don_hang == $key ? 'selected' : '' }}
                                                            {{ $key == 'huy_hang' ? 'disabled' : '' }}>
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>

                                        </td>
                                        <td>
                                            <a href="{{ route('admins.donhangs.show', $item->id) }}">
                                                <i class="mdi mdi-eye"></i>
                                            </a>

                                            @if ($item->trang_thai_don_hang == 'huy_hang')
                                                <form action="{{ route('admins.donhangs.destroy', $item->id) }}"
                                                    method="post" class="d-inline "
                                                    onsubmit="return confirm('bạn có muốn xóa không ?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="border-0 bg-white"><i
                                                            class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i></button>
                                                </form>
                                            @endif
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
@section('js')
    <script>
        function confirmSubmit(selectElement) {
            if (confirm("bạn có chắc muốn thay đổi trạng thái đơn hàng ")) {
                selectElement.closest('form').submit();
            } else {
                // Revert to original value if the user cancels
                selectElement.value = selectElement.getAttribute('data-default-value');
            }
        }
    </script>
@endsection
