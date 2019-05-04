@extends('layouts.client')
@section('title','Information User')
@section('slidebar')
    <section class="home-slider owl-carousel">
        @if($slidebars->count() > 0)
            @foreach($slidebars as $slidebar)
                <div class="slider-item" style="background-image: url({{asset("images/slidebars/$slidebar->url")}});">
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="row slider-text align-items-end">
                            <div class="col-md-10 col-sm-12 ftco-animate mb-4">
                                <p class="breadcrumbs"><span class="mr-2"><a
                                                href="{{route('client.index')}}">Home</a></span>
                                    <span>History</span></p>
                                <h1 class="mb-3">History Booked</h1>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </section>
@endsection
@section('content')
    <section class="ftco-section contact-section" id="contactForm">
        <div class="container bg-light">
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-6 mb-4">
                    <h3 class="text-danger">History booked of {{$user->name}}</h3>
                </div>
            </div>
            <div class="row block-9">

            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).on("ready", function () {
            $('html, body').animate({
                scrollTop: $("#contactForm").offset().top
            }, 1000);
        });
    </script>
@endpush
