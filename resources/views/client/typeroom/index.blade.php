@extends('layouts.client')
@section('title','Rooms & Price')
@section('slidebar')
    <section class="home-slider owl-carousel">
        @if($slidebars->count() > 0)
            @foreach($slidebars as $slidebar)
                <div class="slider-item" style="background-image: url('images/slidebars/{{$slidebar->url}}');">
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="row slider-text align-items-end">
                            <div class="col-md-10 col-sm-12 ftco-animate mb-4">
                                <p class="breadcrumbs"><span class="mr-2"><a href="{{route('client.index')}}">Home</a></span> <span>Rooms</span></p>
                                <h1 class="mb-3">Rooms</h1>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </section>
@endsection
@section('content')
    <section class="ftco-section bg-light" id="typeRooms">
        <div class="container">
            <div class="col-md">
                <div class="ftco-footer-widget mb-4 text-center header-title">
                    <h2>Rooms & Price</h2>
                    <h5>All rooms in the hotel are designed and decorated in a modern and luxurious style with the most modern facilities to create a cozy,
                        luxurious and impressive space.</h5>
                </div>
                <div class="row">
                    @foreach($typeRooms as $typeRoom)
                        <div class="col-md-12 amenities d-md-flex ftco-animate" style="margin: 30px;">
                            <div class=" row one-half order-last text" style="width: 100%">
                                <div class="col-md-6">
                                    <div class="row">
                                        <h2>{{$typeRoom->name}}</h2>
                                        <p>{!! $typeRoom->description !!}</p>
                                        <h3 class="text-danger">Price: ${{$typeRoom->price}}@if($typeRoom->sale > 0) &divideontimes; Sale: {{$typeRoom->sale}}% @endif</h3>
                                    </div>
                                    <div class="row booking">
                                        <a href="{{route('client.typerooms.detail', $typeRoom->id)}}" class="btn btn-primary btn-xs">View...</a>
                                        <a href="#" class="btn btn-outline-danger btn-xs">Booking Now</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @if($typeRoom->images->first() !== null)
                                        <img src="{{asset("images/admin/library-images")}}/{{$typeRoom->images->first()['url']}}" alt="images" width="300px" height="300px">
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).on("ready",function () {
            $('html, body').animate({
                scrollTop: $("#typeRooms").offset().top
            }, 1000);
        });
    </script>
@endpush
