@extends('layouts.client')
@section('title')
    Login
@endsection
@section('content')
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('trangChu')}}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">login-Register</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="login-register-wrapper section-padding">
    <div class="container">
        <div class="member-area-from-wrap">
            <div class="row">
                <!-- Login Content Start -->
                <div class="col-lg-8">
                    <div class="login-reg-form-wrap">
                        <h5>Sign In</h5>
                        <form action="{{route('login') }}" method="post">
                            @csrf
                            <div class="single-input-item">
                                <input type="email" placeholder="Email or Username" required="required" value="{{ old('email') }}" autocomplete="email" name="email" />
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            </div>
                            <div class="single-input-item">
                                <input type="password" placeholder="Enter your Password" required name="password" />
                            </div>
                            <div class="single-input-item">
                                <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                    <div class="remember-meta">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="rememberMe">
                                            <label class="custom-control-label" for="rememberMe">Remember Me</label>
                                        </div>
                                    </div>
                                    <a href="#" class="forget-pwd">Forget Password?</a>
                                    <a href="{{route('showFormRegister')}}" class="forget-pwd">Register</a>
                                </div>
                            </div>
                            <div class="single-input-item">
                                <button class="btn btn-sqr">Login</button>
                            </div>
                            @if ($errors->has('email'))
                            <div class="alert alert-danger">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        </form>
                    </div>
                </div>
                <!-- Login Content End -->

                <!-- Register Content Start -->
               
                <!-- Register Content End -->
            </div>
        </div>
    </div>
</div>
@endsection
