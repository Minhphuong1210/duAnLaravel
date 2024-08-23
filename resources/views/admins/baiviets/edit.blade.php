<div>
    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
</div>


@extends('layouts.admin')
@section('title')
   Sửa bài viết
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
                        <form action="{{ route('admins.baiviets.update',$baiviet->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-4">

                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Tiêu đề </label>
                                        <input type="text" id="simpleinput"
                                            class="form-control"
                                            name="tieu_de"
                                            placeholder="Tên danh mục " value="{{$baiviet->tieu_de}}">
                                        @error('tieu_de')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Ảnh Content</label>
                                        <input type="file" id="simpleinput"
                                            class="form-control"
                                            name="hinh_anh" value="{{ $baiviet->hinh_anh }}"
                                            placeholder="Tên danh mục ">
                                       <img src="{{Storage::url($baiviet->hinh_anh)}}" alt="" width="100px">
                                    </div>
                                </div>

                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Mô tả chi tiết sản phẩm</label>
                                        <div id="quill-editor" style="height: 400px;">
                                        </div>
                                        <textarea name="noi_dung" id="mo_ta_anh_content" class="d-none">{{$baiviet->noi_dung}}</textarea>
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

            var old_content = `{!! $baiviet->noi_dung !!}`;
            quill.root.innerHTML = old_content;

            // cập nhật lại textarea ẩn khi nội dung của quill-editor thay đổi 
            quill.on('text-change', function() {
                var html = quill.root.innerHTML;
                document.getElementById('mo_ta_anh_content').value = html;
            });
        });
</script>
@endsection

