@extends('layouts.client')
@section('title','Promotion')
@section('slidebar')
    <section class="home-slider owl-carousel">
        @if($slidebars->count() > 0)
            @foreach($slidebars as $slidebar)
                <div class="slider-item"
                     style="background-image: url({{asset("images/slidebars")}}/{{$slidebar->url}});">
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="row slider-text align-items-end">
                            <div class="col-md-10 col-sm-12 ftco-animate mb-4">
                                <p class="breadcrumbs"><span class="mr-2"><a
                                            href="{{route('client.index')}}">Home</a></span> <span>Promotion</span></p>
                                <h1 class="mb-3">Promotion</h1>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </section>
@endsection
@section('content')
    <section class="ftco-section bg-light" id="promotions">
        <div class="container">
            <div class="col-md">
                <div class="ftco-footer-widget mb-4 text-center header-title">
                    <h2><a href="{{route('client.promotions')}}">Promotions</a></h2>
                    <h5>Great deals at DaNang Central Hotel | Hotel MayStar</h5>
                </div>
                <div class="row">
                    @foreach($promotions as $promotion)
                        <div class="col-md-12 amenities d-md-flex ftco-animate" style="margin: 30px;">
                            <div class=" row one-half order-last text promotion" style="width: 100%">
                                <div class="col-md-12">
                                    <h3 class="text-danger">{{$promotion->title}}</h3>
                                    <h5 class="text-danger">Date : {{$promotion->startDate}} &hercon; {{$promotion->endDate}}</h5>
                                    <p class="text-justify">{!! $promotion->description !!}</p>
                                </div>
                                <div class="col-md-12 text-right">
                                    <a href="{{route('client.typerooms.index')}}" class="btn btn-primary btn-sm">Booking Now</a>
                                </div>
                                <div id="promoton-sale">
                                    Sale : {{$promotion->sale}}% <br> for {{Carbon\Carbon::now()->diffInDays($promotion->endDate)}} day
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
                scrollTop: $("#promotions").offset().top
            }, 1000);
        });
    </script>
@endpush
