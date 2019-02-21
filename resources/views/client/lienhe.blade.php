@extends('layouts.client')
@section('title','Liên Hệ')
@section('slidebar')
    <section class="home-slider owl-carousel">
        @if($slidebars->count() > 0)
            @foreach($slidebars as $slidebar)
                <div class="slider-item" style="background-image: url('images/slidebars/{{$slidebar->url}}');">
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="row slider-text align-items-end">
                            <div class="col-md-10 col-sm-12 ftco-animate mb-4">
                                <p class="breadcrumbs"><span class="mr-2"><a href="{{route('trang-chu')}}">Trang chủ</a></span> <span>Liên Hệ</span></p>
                                <h1 class="mb-3">Liên Hệ</h1>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </section>
@endsection
@section('content')
    <section class="ftco-section contact-section">
        <div class="container bg-light">
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-12 mb-4">
                    <h2 class="h4">Thông tin liên hệ</h2>
                </div>
                <div class="w-100"></div>
                <div class="col-md-3">
                    <p><span>Địa chỉ:</span> Đà Nẵng</p>
                </div>
                <div class="col-md-3">
                    <p><span>Điện thoại:</span> <a href="tel://1234567920">0335833102</a></p>
                </div>
                <div class="col-md-3">
                    <p><span>Email:</span> <a href="mailto:info@yoursite.com">maystar@gmail.com</a></p>
                </div>
            </div>
            <div class="row block-9">
                <div class="col-md-6 pr-md-5">
                    <form method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Họ & Tên">
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Tiêu Đề">
                        </div>
                        <div class="form-group">
                            <textarea name="" id="" cols="30" rows="7" name="content" class="form-control" placeholder="Nội Dung"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Gửi" class="btn btn-primary py-3 px-5">
                        </div>
                    </form>

                </div>

                <div class="col-md-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.1193452282473!2d105.80084231480194!3d21.027910185998795!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab424a50fff9%3A0xbe3a7f3670c0a45f!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBHaWFvIHRow7RuZyB24bqtbiB04bqjaQ!5e0!3m2!1svi!2s!4v1547262780009" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection
