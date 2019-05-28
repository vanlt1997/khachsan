@extends('layouts.client')
@section('title','Introduction')
@section('slidebar')
    <section class="home-slider owl-carousel">
        @if($slidebars->count() > 0)
            @foreach($slidebars as $slidebar)
                <div class="slider-item" style="background-image: url('images/slidebars/{{$slidebar->url}}');">
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="row slider-text align-items-end">
                            <div class="col-md-10 col-sm-12 ftco-animate mb-4">
                                <p class="breadcrumbs"><span class="mr-2"><a href="{{route('client.index')}}">Home</a></span> <span>Introduce</span></p>
                                <h1 class="mb-3">Introduce</h1>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </section>
@endsection
@section('content')
    <section class="ftco-section-2" id="intro">
        <div class="container d-flex">
            <div class="section-2-blocks-wrapper row d-flex">
                <div class="img col-sm-12 col-lg-6 order-last" style="background-image: url({{asset('images/about-2.jpg')}});">
                </div>
                <div class="text col-lg-6 order-first ftco-animate">
                    <div class="text-inner align-self-start">
                        <span class="subheading">Information MayStar</span>
                        <h3 class="heading text-danger">Welcom to MayStar</h3>
                        <p>Located in a beautiful location in the heart of Da Nang, Vietnam, Danang MayStar Hotel welcomes all guests looking for a luxurious base with top amenities and the most attentive service at Vietnam.</p>

                        <p>Luxurious and comfortable rooms, from the modern conference room to the international buffet restaurant, MayStar hotel becomes the perfect choice for work or leisure. Maystar Da Nang also brings a world
                            attractive cuisine for guests to explore, from international themed buffet meals, you will be served at the hotel’s restaurant on the 3rd floor.</p>
                        <p>Located in a prime location in Danang, the hotel is very close to key districts and major attractions. Honor the rich culture of the land
                            In this country, the hotel’s hotel reception offers many options for you to explore Vietnam.</p>
                        <p>
                            All rooms have beautiful views, excellent staff and outstanding facilities, MayStar Danang is the perfect place for anyone who wants to dispel the hustle and bustle of the city to experience the moments of the letter. great relaxation.
                            Located in the center with nearby main attractions
                            Elegant interior with beautiful cityscape
                            Great conference and conference equipment
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="testimony-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h2 class="text-danger">Hotel MayStar</h2>
                </div>
            </div>
            <div class="row">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="gioithieu">
                                <img src="{{asset('images/introduction/gt_1.jpg')}}" alt="images">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 gioithieu">
                            <div class="gioithieu">
                                <img src="{{asset('images/introduction/gt_2.jpg')}}" height="164.89px" alt="images">
                            </div>
                        </div>
                        <div class="col-md-6 gioithieu">
                            <div class="gioithieu">
                                <img src="{{asset('images/introduction/gt_3.jpg')}}" height="164.89px" alt="images">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="gioithieu-content">
                            <p>
                                Located in central Da Nang, Maystar International Hotel has 60 rooms. Tourists can
                                Enjoy a meal at the hotel’s restaurant. All rooms have WiFi networks
                                free.
                            </p>
                        </div>
                        <div class="gioithieu-content">
                            <p>
                                This is a great choice for business trips and for travelers
                                Favorite shopping, cuisine and street space.
                            </p>
                        </div>
                        <div class="gioithieu-content">
                            <p>
                                We speak in your language!
                            </p>
                        </div>
                        <div class="gioithieu-content">
                            <p>
                                Maystar has welcomed international guests since January 1, 2019.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>

    <section class="ftco-section-2 testimony-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h2 class="text-danger">Cosy</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="gioithieu-content" style="margin-left: 0">
                        <p>
                            Each guest room at MayStar Hotel is equipped with a flat-screen TV. Some rooms are okay
                            Designed with space for a seating area for your convenience. All rooms are
                            Equipped with modern equipment, mini bar, windows with panoramic views of Danang
                            Guests can contact the 24-hour front desk for assistance with currency exchange, tour arrangements and translation
                            Special support.
                        </p>
                    </div>
                    <div class="gioithieu-content" style="margin-left: 0">
                        <p>
                            Guests can contact the 24-hour front desk for assistance with currency exchange, tour arrangements and translation
                            Special support.
                        </p>
                    </div>
                    <div class="gioithieu-content" style="margin-left: 0">
                        <p>
                            Guests can contact the 24-hour front desk for assistance with currency exchange, tour arrangements and translation
                            Special support.
                        </p>
                    </div>
                    <div class="gioithieu-content" style="margin-left: 0">
                        <p>
                            This is also a convenient location for 45-seater parking, allowing the organization of tour groups with different scales.
                            Tourists can feel the luxury of space here.
                        </p>
                    </div>
                    <div>
                        <p><a href="{{route('client.typerooms.index')}}" class="btn btn-primary">Back to cosy</a></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="gioithieu">
                                <img src="{{asset('images/introduction/tn_1.jpg')}}" alt="images">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 gioithieu">
                            <div class="gioithieu">
                                <img src="{{asset('images/introduction/tn_2.jpg')}}" alt="images">
                            </div>
                        </div>
                        <div class="col-md-6 gioithieu">
                            <div class="gioithieu">
                                <img src="{{asset('images/introduction/tn_3.jpg')}}" height="164.89px" alt="images">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="testimony-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <h2 class="text-danger">Location & Contact</h2>
                </div>
            </div>
            <div class="row">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="gioithieu">
                                    <img src="{{asset('images/introduction/lh.jpg')}}" alt="images">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12 gioithieu-content">
                            <p>
                                Convenient location and easy to move. Right downtown. All obstacles
                                become easier.
                            </p>
                            <p><a href="{{route('client.contact')}}" class="btn btn-primary">Back to contact</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('content')
    @push('scripts')
        <script>
            $(document).on("ready",function () {
                $('html, body').animate({
                    scrollTop: $("#intro").offset().top
                }, 1000);
            });
        </script>
    @endpush
