<div>
    <!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
</div>

@extends('layouts.admin')
@section('title')
   Thêm bài viết
@endsection
@section('css')
    <link href="{{ asset('assets/admin/assets/libs/quill/quill.core.js') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/assets/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <h5 class="card-title mb-0">Input Type</h5>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 ">
                        <form action="{{ route('admins.baiviets.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4">

                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Tiêu đề </label>
                                        <input type="text" id="simpleinput"
                                            class="form-control  @error('ten_danh_muc') is-invalid @enderror"
                                            name="tieu_de" value="{{ old('tieu_de') }}"
                                            placeholder="Tên danh mục ">
                                        @error('tieu_de')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Ảnh Content</label>
                                        <input type="file" id="simpleinput"
                                            class="form-control  @error('hinh_anh') is-invalid @enderror"
                                            name="hinh_anh" value="{{ old('hinh_anh') }}"
                                            placeholder="Tên danh mục ">
                                        @error('hinh_anh')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Mô tả chi tiết sản phẩm</label>
                                        <div id="quill-editor" style="height: 400px;">
                                        </div>
                                        <textarea name="noi_dung" id="mo_ta_anh_content" class="d-none"></textarea>
                                    </div>
                                </div>

                            </div>


                            <button type="submit" class="btn btn-primary justify-content-center">Gửi</button>

                        </form>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('assets/admin/assets/libs/quill/quill.core.js') }}"></script>
<script src="{{ asset('assets/admin/assets/libs/quill/quill.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var quill = new Quill("#quill-editor", {
            theme: "snow",
        });

        var old_content = `{!! old('mo_ta_anh') !!}`;
        quill.root.innerHTML = old_content;

        // cập nhật lại textarea ẩn khi nội dung của quill-editor thay đổi 
        quill.on('text-change', function() {
            var html = quill.root.innerHTML;
            document.getElementById('mo_ta_anh_content').value = html;
        });
    });
</script>
@endsection
