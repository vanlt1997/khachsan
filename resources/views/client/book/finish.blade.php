@extends('layouts.client')
@section('title','Booking')
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
                                                href="{{route('client.index')}}">Home</a></span> <span>Booking</span>
                                </p>
                                <h1 class="mb-3">Booking</h1>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </section>
@endsection
@section('content')
    <section class="ftco-section contact-section" id="confirm">
        <div class="container bg-light">
            <h4 class="text-success">
                Thank you for book our room. Please check the email for book information and wait feedback from us.
            </h4>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).on("ready", function () {
            $('html, body').animate({
                scrollTop: $("#confirm").offset().top
            }, 1000);
        });
    </script>
@endpush
