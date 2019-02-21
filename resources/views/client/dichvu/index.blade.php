@extends('layouts.client')
@section('title','Dịch Vụ')
@section('slidebar')
    <section class="home-slider owl-carousel">
        @if($slidebars->count() > 0)
            @foreach($slidebars as $slidebar)
                <div class="slider-item" style="background-image: url('images/slidebars/{{$slidebar->url}}');">
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="row slider-text align-items-end">
                            <div class="col-md-10 col-sm-12 ftco-animate mb-4">
                                <p class="breadcrumbs"><span class="mr-2"><a href="{{route('trang-chu')}}">Trang chủ</a></span> <span>Dịch Vụ</span></p>
                                <h1 class="mb-3">Dịch Vụ</h1>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </section>
@endsection
@section('content')
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row no-gutters">
                @foreach($services as $key =>$service)
                    @if($key%2 == 0)
                        <div class="amenities d-md-flex ftco-animate">
                            <div class="one-half order-first img" style="background-image: url({{asset('images/services/')}}/{{$service->icon}});"></div>
                            <div class="one-half order-last text">
                                <h2>{{$service->name}}</h2>
                                <p>{!! $service->description !!}</p>
                                <p><a href="{{route('chi-tiet-dich-vu',$service->aliases)}}" class="btn btn-primary">Xem thêm</a></p>
                            </div>
                        </div>
                    @else
                        <div class="amenities d-md-flex ftco-animate">
                            <div class="one-half order-last img" style="background-image: url({{asset('images/services/')}}/{{$service->icon}});"></div>
                            <div class="one-half order-first text">
                                <h2 class="mb-4">{{$service->name}}</h2>
                                <p>{!! $service->description !!}</p>
                                <p><a href="{{route('chi-tiet-dich-vu',$service->aliases)}}" class="btn btn-primary">Xem thêm</a></p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endsection
