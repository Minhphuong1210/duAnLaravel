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
                            <li class="breadcrumb-item"><a href="{{route('trangChu')}}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">contact us</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

<!-- google map start -->
<div class="map-area section-padding">
    <div id="google-map"></div>
</div>
<!-- google map end -->

<!-- contact area start -->
<div class="contact-area section-padding pt-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="contact-message">
                    <h4 class="contact-title">Tell Us Your Project</h4>
                    <form id="contact-form" action="{{route('senMail')}}" method="post" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input name="name" placeholder="Name *" type="text" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input name="phone" placeholder="Phone *" type="text" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input name="email" placeholder="Email *" type="text" required>
                            </div>
                            <div class="col-12">
                                <div class="contact2-textarea text-center">
                                    <textarea placeholder="Message *" name="noidung" class="form-control2" required=""></textarea>
                                </div>
                                <div class="contact-btn">
                                    <button class="btn btn-sqr" type="submit">Send Message</button>
                                </div>
                            </div>
                          
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="contact-info">
                    <h4 class="contact-title">Contact Us</h4>
                    <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum
                        est notare quam littera gothica, quam nunc putamus parum claram anteposuerit litterarum
                        formas human.</p>
                    <ul>
                        <li><i class="fa fa-fax"></i> Address : Thôn vài mới, Xã Hợp Thanh , Huyện Mỹ Đức, Hà Nôin</li>
                        <li><i class="fa fa-phone"></i> E-mail: chuphuong10d3@gmail.com</li>
                        <li><i class="fa fa-envelope-o"></i> 0347247627</li>
                    </ul>
                    <div class="working-time">
                        <h6>Working Hours</h6>
                        <p><span>Monday – Saturday:</span>08AM – 22PM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection