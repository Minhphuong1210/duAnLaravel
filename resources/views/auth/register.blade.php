@extends('layouts.client')
@section('title')
@endsection
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('trangChu') }}"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">login-Register</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>Register for new account</h2>
        <div class="fxt-form">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="col-lg-6">
                    <div class="login-reg-form-wrap sign-up-form">
                        <h5>Singup Form</h5>
                        <form action="{{ route('register') }}" method="post">
                            <div class="single-input-item">
                                <input type="text" placeholder="Full Name" required name="name" />
                            </div>
                            <div class="single-input-item">
                                <input type="email" placeholder="Enter your Email" required name="email" />
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="single-input-item">
                                        <input type="password" placeholder="Enter your Password" required name="password" />
                                    </div>
                                </div>

                            </div>

                            <div class="single-input-item">
                                <button class="btn btn-sqr">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </form>
        </div>
        <div class="fxt-footer">
            <div class="fxt-transformY-50 fxt-transition-delay-9">
                <p>Already have an account?<a href="{{ route('login') }}" class="switcher-text2 inline-text">Log in</a></p>
            </div>
        </div>
    </div>
@endsection
