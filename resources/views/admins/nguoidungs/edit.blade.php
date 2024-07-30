@extends('layouts.admin')
@section('title')
    người dùng {{$nguoiDung->name}}
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
                            <form action="{{ route('admins.nguoidungs.update',['id'=>$nguoiDung->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Tên người dùng </label>
                                            <input type="text" id="simpleinput"
                                                class="form-control  @error('name') is-invalid @enderror"
                                                name="name" value="{{ $nguoiDung->name }}"
                                                placeholder="name ">
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                   
                                   
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Email</label>
                                            <input type="email" id="simpleinput"
                                                class="form-control  @error('email') is-invalid @enderror"
                                                name="email" value="{{ $nguoiDung->email }}"
                                                placeholder="email ">
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">password</label>
                                            <input type="password" id="simpleinput"
                                                class="form-control  @error('password') is-invalid @enderror"
                                                name="password" value="{{ $nguoiDung->password }}"
                                                placeholder="password ">
                                            @error('password')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Phân Quyền</label>
                                            <select class="form-select"  name="role">

                                                <option value="{{\App\Models\User::ROLE_ADMIN}}" {{$nguoiDung->role ==\App\Models\User::ROLE_ADMIN ? 'selected':''}}>{{\App\Models\User::ROLE_ADMIN}}</option>
                                                <option value="{{\App\Models\User::ROLE_USER}}" {{$nguoiDung->role ==\App\Models\User::ROLE_USER ? 'selected':''}}>{{\App\Models\User::ROLE_USER}}</option>
                                              </select>
                                        </div>
                                    </div>
                                </div>

                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">Trạng thái hoạt động</legend>
                                    <div class="col-sm-10 d-flex gap-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_active"
                                                id="gridRadios1" value="1"  {{$nguoiDung->is_active ==1 ?'checked':''}}>
                                            <label class="form-check-label" for="gridRadios1">
                                                Hiện thị
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_active"
                                                id="gridRadios2" value="0" {{$nguoiDung->is_active ==0 ?'checked':''}}>
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
