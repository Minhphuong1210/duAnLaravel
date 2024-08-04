@extends('layouts.admin')
@section('title')
    thêm sản phẩm
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
                            <form action="{{ route('admins.danhmucs.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Tên danh mục</label>
                                            <input type="text" id="simpleinput"
                                                class="form-control  @error('ten_danh_muc') is-invalid @enderror"
                                                name="ten_danh_muc" value="{{ old('ten_danh_muc') }}"
                                                placeholder="Tên danh mục ">
                                            @error('ten_danh_muc')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Hình ảnh danh mục</label>
                                            <input type="file" id="simpleinput" class="form-control" name="hinh_anh"
                                                onchange="showImage(event)" id="hinh_anh">
                                            <img src="" alt="Hình ảnh sản phẩm" style="width:150px; display:none"
                                                id="img_danh_muc">
                                        </div>
                                    </div>
                                </div>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Trạng thái hoạt động</legend>
                                    <div class="col-sm-10 d-flex gap-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="trang_thai"
                                                id="gridRadios1" value="1" checked>
                                            <label class="form-check-label" for="gridRadios1">
                                                Hiện thị
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="trang_thai"
                                                id="gridRadios2" value="0">
                                            <label class="form-check-label" for="gridRadios2">
                                                Ẩn
                                            </label>
                                        </div>

                                    </div>
                                </fieldset>


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
    <script>
        function showImage(event) {
            const img_danh_muc = document.getElementById('img_danh_muc');
            console.log(img_danh_muc)
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                img_danh_muc.src = reader.result;
                img_danh_muc.style.display = 'block';
            }
            if(file){
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
