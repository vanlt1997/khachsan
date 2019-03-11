@extends('layouts.client')
@section('title','Services')
@section('slidebar')
    <section class="home-slider owl-carousel">
        @if($slidebars->count() > 0)
            @foreach($slidebars as $slidebar)
                <div class="slider-item" style="background-image: url({{asset("images/slidebars")}}/{{$slidebar->url}});">
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="row slider-text align-items-end">
                            <div class="col-md-10 col-sm-12 ftco-animate mb-4">
                                <p class="breadcrumbs"><span class="mr-2"><a href="{{route('client.index')}}">Home</a></span> <span>Services</span></p>
                                <h1 class="mb-3">{{$service->name}}</h1>
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
            <div class="col-md">
                <div class="ftco-footer-widget mb-4 text-center header-title">
                    <h2 class="ftco-heading-2">{{$service->name}}</h2>
                    <h4>Hotel <a href="{{route('client.index')}}">MayStar</a></h4>
                </div>
                <div class="row">
                    <div class="{{$service->images->isEmpty() ? 'col-md-12' : 'col-md-4'}}">
                        <p class="text-justify">{!! $service->description !!}</p>
                    </div>
                    <div class="col-md-8 row no-gutters">
                        @foreach($service->images as $image)
                            <div class="col-sm-12 col-md-3 ftco-animate">
                                <div class="image-detail">
                                    <div class="detail" style="background-image: url({{asset("images/admin/library-images/$image->url")}})">
                                        <a href="{{asset("images/admin/library-images/$image->url")}}" class="insta-img image-popup">
                                            <div class="icon d-flex justify-content-center">
                                                <span class="icon-instagram align-self-center"></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>


                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
