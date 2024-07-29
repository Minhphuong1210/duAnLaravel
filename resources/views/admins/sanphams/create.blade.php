@extends('layouts.admin')
@section('title')
    thêm sản phẩm
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
                            <form action="{{ route('admins.sanphams.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4">

                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Mã sản phẩm</label>
                                            <input type="text" id="simpleinput"
                                                class="form-control  @error('ten_danh_muc') is-invalid @enderror"
                                                name="ma_san_pham" value="{{ old('ma_san_pham') }}"
                                                placeholder="Tên danh mục ">
                                            @error('ma_san_pham')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Tên sản phẩm</label>
                                            <input type="text" id="simpleinput"
                                                class="form-control  @error('ten_san_pham') is-invalid @enderror"
                                                name="ten_san_pham" value="{{ old('ten_san_pham') }}"
                                                placeholder="Tên danh mục ">
                                            @error('ten_san_pham')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>



                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Giá sản phẩm</label>
                                            <input type="number" id="simpleinput"
                                                class="form-control  @error('gia_san_pham') is-invalid @enderror"
                                                name="gia_san_pham" value="{{ old('gia_san_pham') }}"
                                                placeholder="Tên danh mục ">
                                            @error('gia_san_pham')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>



                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Giá khuyến mãi</label>
                                            <input type="number" id="simpleinput"
                                                class="form-control  @error('gia_khuyen_mai') is-invalid @enderror"
                                                name="gia_khuyen_mai" value="{{ old('gia_khuyen_mai') }}"
                                                placeholder="Tên danh mục ">
                                            @error('gia_khuyen_mai')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>



                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Danh mục</label>
                                            <select name="danh_muc_id"
                                                class="form-select  @error('danh_muc_id') is-invalid @enderror">
                                                <option selected>-- Chọn danh mục --</option>
                                                @foreach ($listDanhMuc as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('danh_muc_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->ten_danh_muc }}</option>
                                                @endforeach
                                            </select>
                                            @error('danh_muc_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>



                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Số lượng</label>
                                            <input type="number" id="simpleinput"
                                                class="form-control  @error('so_luong') is-invalid @enderror"
                                                name="so_luong" value="{{ old('so_luong') }}"
                                                placeholder="số lượng sản phẩm ">
                                            @error('so_luong')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>



                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Ngày nhập</label>
                                            <input type="date" id="simpleinput"
                                                class="form-control  @error('ngay_nhap') is-invalid @enderror"
                                                name="ngay_nhap" value="{{ old('ngay_nhap') }}" placeholder="Ngày nhập ">
                                            @error('ngay_nhap')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>




                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Mô tả ngắn</label>


                                            <textarea name="mo_ta_ngan" id="" cols="30" rows="3"
                                                class="form-control  @error('mo_ta_ngan') is-invalid @enderror" name="mo_ta_ngan" value="{{ old('mo_ta_ngan') }}"
                                                placeholder="Ngày nhập "></textarea>
                                            @error('mo_ta_ngan')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        @php
                                            $Is = [
                                                'is_new' => ['name' => 'Is New', 'class' => 'bg-danger'],
                                                'is_hot' => ['name' => 'Is Hot', 'class' => 'bg-warning'],
                                                'is_hot_deal' => ['name' => 'Is Hot Deal', 'class' => 'bg-success'],
                                                'is_show_home' => ['name' => 'Is Show Home', 'class' => 'bg-primary'],
                                            ];
                                        @endphp
                                        <label for="simpleinput" class="form-label">Tùy chỉnh khác</label>
                                        <div class="form-switch mb-2 ps-3 d-flex justify-content-between">
                                            @foreach ($Is as $id => $label)
                                                <div class="form-check">
                                                    <input class="form-check-input {{ $label['class'] }}" type="checkbox"
                                                        role="switch" id="{{ $id }}" checked
                                                        name="{{ $id }}">
                                                    <label class="form-check-label"
                                                        for="{{ $id }}">{{ $label['name'] }}</label>
                                                </div>
                                            @endforeach
                                        </div>

                                        <fieldset class="row mb-3">
                                            <legend class="col-form-label col-sm-2 pt-0">Trạng thái hoạt động</legend>
                                            <div class="col-sm-10 d-flex gap-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_type"
                                                        id="gridRadios1" value="1" checked>
                                                    <label class="form-check-label" for="gridRadios1">
                                                        Hiện thị
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_type"
                                                        id="gridRadios2" value="0">
                                                    <label class="form-check-label" for="gridRadios2">
                                                        Ẩn
                                                    </label>
                                                </div>

                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Mô tả chi tiết sản phẩm</label>
                                            <div id="quill-editor" style="height: 400px;">
                                            </div>
                                            <textarea name="mo_ta_anh" id="mo_ta_anh_content" class="d-none"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Hình ảnh danh mục</label>

                                            <input type="file" id="simpleinput" class="form-control" name="hinh_anh_san_pham"
                                                onchange="showImage(event)" id="hinh_anh">
                                            <img src="" alt="Hình ảnh sản phẩm" style="width:150px; display:none"
                                                id="img_danh_muc">
                                        </div>

                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Album hình ảnh</label>
                                            <i class="mdi mdi-plus text-muted fs-18 rounded-2 border p-1 ms-3"
                                                style="cursor: pointer" id="add-row"></i>
                                            <table class="table align-middle table-nowrap mb-0">
                                                <tbody id="image-table-body">
                                                    <tr class="">
                                                        <td class="d-flex align-items-center">
                                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0Wr3oWsq6KobkPqznhl09Wum9ujEihaUT4Q&s"
                                                                alt="Hình ảnh sản phẩm" id="preview_0" width="50px"
                                                                class="me-3">
                                                            <input type="file" class="form-control"
                                                                name="list_hinh_anh[id_0]" onchange="previewImage(this,0)"
                                                                id="hinh_anh">
                                                        </td>
                                                        <td>
                                                            <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"
                                                                style="cursor: pointer"></i>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
    {{-- đây là phần của nội dung --}}
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
    {{-- đây là phần hiện ảnh  --}}
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
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

    {{--  đây là list ảnh --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rowCount = 1;
           document.getElementById('add-row').addEventListener('click',function(e){
            var tableBody = document.getElementById('image-table-body');
            var newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td class="d-flex align-items-center">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0Wr3oWsq6KobkPqznhl09Wum9ujEihaUT4Q&s"
                        alt="Hình ảnh sản phẩm" id="preview_${rowCount}" width="50px"
                        class="me-3">
                    <input type="file" class="form-control"
                        name="list_hinh_anh[id_${rowCount}]" onchange="previewImage(this,${rowCount})"
                        id="hinh_anh">
                </td>
                <td>
                    <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"
                    style="cursor: pointer" onclick="removeRow(this)"></i>
                </td>
            `;
            tableBody.appendChild(newRow);
            rowCount++;

           })
        })
        function previewImage(input, rowIndex){
         if(input.files && input.files[0]){
            const reader = new FileReader();
            reader.onload = function(e) {
               document.getElementById(`preview_${rowIndex}`).setAttribute(`src`,e.target.result)
            }
          
                reader.readAsDataURL(input.files[0]);
         }
        }
        function removeRow(item){
            var row = item.closest(`tr`);
            if (row) {
                row.remove(); 
            }
        }
    </script>
@endsection
