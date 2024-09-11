<div>
    <!-- The biggest battle is the war against ignorance. - Mustafa Kemal Atatürk -->
</div>
@extends('layouts.admin')
@section('title')
    Sửa khuyến mại
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
                            <form action="{{ route('admins.khuyenmais.update',$Promotion->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-8">

                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Mã Khuyến mại</label>
                                            <input type="text" id="simpleinput"
                                                class="form-control  @error('code') is-invalid @enderror" name="code"
                                                value="{{ $Promotion->code }}" placeholder="code ">
                                            @error('code ')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">discount</label>
                                            <input type="text" id="simpleinput"
                                                class="form-control  @error('discount') is-invalid @enderror"
                                                name="discount" value="{{ $Promotion->discount }}" placeholder="discount">
                                            @error('discount')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <fieldset class="row mb-3">
                                            <legend class="col-form-label col-sm-2 pt-0">Phần trăm hay giá tiền</legend>
                                            <div class="col-sm-10 d-flex gap-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="discount_type"
                                                        id="gridRadios1" value="{{ $DISCOUNT_Percentage }}"
                                                        {{ $Promotion->discount_type == $DISCOUNT_Percentage ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="gridRadios1">
                                                        {{ $DISCOUNT_Percentage }}
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="discount_type"
                                                        id="gridRadios2" value="{{ $DISCOUNT_Fixed }}"
                                                        {{ $Promotion->discount_type == $DISCOUNT_Fixed ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="gridRadios2">
                                                        {{ $DISCOUNT_Fixed }}
                                                    </label>
                                                </div>

                                            </div>
                                        </fieldset>

                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Ngày bắt đầu</label>
                                            <input type="date" id="simpleinput"
                                                class="form-control  @error('start_date') is-invalid @enderror"
                                                name="start_date" value="{{ $Promotion->start_date }}"
                                                placeholder="start_date">
                                            @error('start_date')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Ngày kết thúc</label>
                                            <input type="date" id="simpleinput"
                                                class="form-control  @error('end_date') is-invalid @enderror"
                                                name="end_date" value="{{ $Promotion->end_date }}" placeholder="end_date">
                                            @error('end_date')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Giới hạn người sử dụng</label>
                                            <input type="number" id="simpleinput"
                                                class="form-control  @error('usage_limit') is-invalid @enderror"
                                                name="usage_limit" value="{{ $Promotion->usage_limit }}"
                                                placeholder="usage_limit">
                                            @error('usage_limit')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <fieldset class="row mb-3">
                                            <legend class="col-form-label col-sm-2 pt-0">Phần trăm hay giá tiền</legend>
                                            <div class="col-sm-10 d-flex gap-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="gridRadios1" value="{{ $STATUS_Active }}"
                                                        {{ $Promotion->status == $STATUS_Active ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="gridRadios1">
                                                        {{ $STATUS_Active }}
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="gridRadios2" value="{{ $STATUS_InActive }}"
                                                        {{ $Promotion->status == $STATUS_InActive ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="gridRadios2">
                                                        {{ $STATUS_InActive }}
                                                    </label>
                                                </div>

                                            </div>
                                        </fieldset>

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
