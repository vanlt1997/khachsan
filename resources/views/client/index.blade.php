@extends('layouts.client')
@section('title','Home')
@section('slidebar')
    <section class="home-slider owl-carousel">
        @foreach($slidebars as $slidebar)
            <div class="slider-item" style="background-image: url('images/slidebars/{{$slidebar->url}}');">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row slider-text align-items-center justify-content-start">
                        <div class="col-md-6 col-sm-12 ftco-animate">
                            <h1 class="mb-4">{{$slidebar->description}}</h1>
                            <p><a href="https://vimeo.com/309627602"
                                  class="btn btn-primary btn-outline-white px-4 py-3 popup-vimeo"><span
                                        class="ion-ios-play mr-2"></span>View Video</a></p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
    <!-- END slider -->
    <div class="ftco-section-reservation">
        <div class="container">
            <div class="row justify-content-end ftco-animate">
                <div class="col-lg-4 col-md-5 reservation p-md-5">
                    <div class="block-17">
                        <form action="" method="post" class="d-block">
                            <div class="fields d-block">

                                <div class="book-date one-third">
                                    <label for="check-in">Checkin:</label>
                                    <input type="text" id="checkin_date" class="form-control" placeholder="M/D/YYYY">
                                </div>

                                <div class="book-date one-third">
                                    <label for="check-out">Checkout:</label>
                                    <input type="text" id="checkout_date" class="form-control" placeholder="M/D/YYYY">
                                </div>

                                <div class="one-third">
                                    <label for="Guest">Number people:</label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <input type="number" id="people" class="form-control" min="0">
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="search-submit btn btn-primary" value="Book">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('content')
    <section class="services bg-light">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-4 ftco-animate py-5 nav-link-wrap aside-stretch">
                    <div class="nav flex-column nav-pills icon_service" id="v-pills-tab" role="tablist"
                         aria-orientation="vertical">
                        @foreach($services as $key => $service)
                                <a class="nav-link px-4 @if($key == 0) active @endif" id="{{$service->id}}-tab" data-toggle="pill"
                                   href="#{{$service->id}}" role="tab" aria-controls="{{$service->id}}"
                                   aria-selected="true">
                                    @if($service->icon !== ''  && $service->icon !== null)<img
                                        src="{{asset('images/services')}}/{{$service->icon}}">@endif {{$service->name}}
                                </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-8 ftco-animate p-4 p-md-5 d-flex align-items-center">

                    <div class="tab-content pl-md-5 show_service" id="v-pills-tabContent">
                        @foreach($services as $key =>$service)
                            <div class="tab-pane fade @if($key == 0)show active @endif" id="{{$service->id}}" role="tabpanel"
                                 aria-labelledby="{{$service->id}}-tab">
                                @if($service->icon !== '' && $service->icon !== null)
                                    <img src="{{asset('images/services/')}}/{{$service->icon}}">@endif
                                <h2 class="mb-4">{{$service->name}}</h2>
                                <p>{!! $service->description !!}</p>
                                <p><a href="{{route('chi-tiet-dich-vu',$service->aliases)}}"
                                      class="btn btn-primary">Xem thêm</a></p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section room-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">OUR ROOM</span>
                    <h2>Discover the rooms</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="carousel-room owl-carousel">
                        @foreach($typeRooms as $typeRoom)
                            <div class="item">
                                <div class="room-wrap">
                                    <a href="#" class="room-img"
                                       style="background-image: url('{{asset('images/admin/library-images')}}/{{$typeRoom->images->first()['url']}}');"></a>
                                    <div class="text p-4">
                                        <div class="d-flex mb-1">
                                            <div class="one-third">
                                                <p class="star-rate"><span class="icon-star"></span><span
                                                        class="icon-star"></span><span class="icon-star"></span><span
                                                        class="icon-star"></span><span
                                                        class="icon-star-half-full"></span>
                                                </p>
                                                <h3><a href="#">{{$typeRoom->name}}</a></h3>
                                            </div>
                                            <div class="one-forth text-center" style="margin-right: 10px">
                                                <p class="price">${{$typeRoom->price}} <br><span>/day</span></p>
                                            </div>
                                            @if($typeRoom->sale !== 0 && $typeRoom->sale !== null)
                                                <div class="one-forth text-center">
                                                    <p class="price">- {{$typeRoom->sale}} <br><span>%</span></p>
                                                </div>
                                            @endif
                                        </div>
                                        <p class="features">
                                            <span class="d-block mb-2"><i class="icon-check mr-2"></i> Perfect for traveling couples</span>
                                            <span class="d-block mb-2"><i
                                                    class="icon-check mr-2"></i> Breakfast included</span>
                                            <span class="d-block mb-2"><i class="icon-check mr-2"></i> Free wifi</span>
                                            <span class="d-block mb-2"><i class="icon-check mr-2"></i> Full facilities</span>
                                            <span class="d-block mb-2"><i class="icon-check mr-2"></i> 24-hour reception</span>
                                        </p>
                                        <p><a href="#" class="btn btn-primary">Book room</a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section-parallax">
        <div class="parallax-img d-flex align-items-md-center align-items-sm-end"
             style="background-image: url('images/bg_4.jpg');" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row desc d-flex justify-content-center">
                    <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                        <span class="subheading">Our Conference</span>
                        <h2 class="h1 font-weight-bold">Conference Centre</h2>
                        <p><a href="#" class="btn btn-primary btn-outline-white mt-3 py-3 px-4">View more details</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Our Menu</span>
                    <h2>Restaurant &amp; Bar</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 dish-menu">

                    <div class="nav nav-pills justify-content-center ftco-animate" id="v-pills-tab" role="tablist"
                         aria-orientation="vertical">
                        <a class="nav-link py-3 px-4 active" id="v-pills-home-tab" data-toggle="pill"
                           href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><span
                                class="flaticon-tray"></span> Main</a>
                        <a class="nav-link py-3 px-4" id="v-pills-profile-tab" data-toggle="pill"
                           href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                           aria-selected="false"><span class="flaticon-beer"></span> Dessert</a>
                        <a class="nav-link py-3 px-4" id="v-pills-messages-tab" data-toggle="pill"
                           href="#v-pills-messages" role="tab" aria-controls="v-pills-messages"
                           aria-selected="false"><span class="flaticon-cheers"></span> Drinks</a>
                    </div>

                    <div class="tab-content py-5" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                             aria-labelledby="v-pills-home-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img" style="background-image: url(images/dish-3.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Grilled Beef with potatoes</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img" style="background-image: url(images/dish-4.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Fruit Vanilla Ice Cream</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img" style="background-image: url(images/dish-5.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Asian Hoisin Pork</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img" style="background-image: url(images/dish-6.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Spicy Fried Rice &amp; Bacon</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img" style="background-image: url(images/dish-7.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Mango Chili Chutney</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img" style="background-image: url(images/dish-8.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Savory Watercress Chinese Pancakes</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img" style="background-image: url(images/dish-9.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Soup With Vegetables And Meat</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img" style="background-image: url(images/dish-10.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Udon Noodles With Vegetables</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img" style="background-image: url(images/dish-11.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Baked Lobster With A Garnish</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img" style="background-image: url(images/dish-8.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Octopus with Vegetables</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- END -->

                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                             aria-labelledby="v-pills-profile-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img"
                                             style="background-image: url(images/dessert-1.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Grilled Beef with potatoes</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img"
                                             style="background-image: url(images/dessert-2.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Grilled Beef with potatoes</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img"
                                             style="background-image: url(images/dessert-3.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Grilled Beef with potatoes</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img"
                                             style="background-image: url(images/dessert-4.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Grilled Beef with potatoes</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img"
                                             style="background-image: url(images/dessert-5.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Grilled Beef with potatoes</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img"
                                             style="background-image: url(images/dessert-6.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Tiramisu</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img"
                                             style="background-image: url(images/dessert-7.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Chocolate Cream</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img"
                                             style="background-image: url(images/dessert-8.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Pizza Pie</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img"
                                             style="background-image: url(images/dessert-9.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Sicilian Ricotta</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img"
                                             style="background-image: url(images/dessert-10.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Mango FLoat</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- END -->

                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                             aria-labelledby="v-pills-messages-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img" style="background-image: url(images/drink-1.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Lemon Juice</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img" style="background-image: url(images/drink-2.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Guava Juice</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img" style="background-image: url(images/drink-3.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Sprite</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img" style="background-image: url(images/drink-4.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Cola</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img" style="background-image: url(images/drink-5.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Wine</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img" style="background-image: url(images/drink-6.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Beer</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img" style="background-image: url(images/drink-7.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Mango Juice</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img" style="background-image: url(images/drink-8.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Apple Juice</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img" style="background-image: url(images/drink-9.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Strawberry Juice</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menus d-flex ftco-animate">
                                        <div class="menu-img" style="background-image: url(images/drink-10.jpg);"></div>
                                        <div class="text d-flex">
                                            <div class="one-half">
                                                <h3>Orange Juice</h3>
                                                <p><span>Meat</span>, <span>Potatoes</span>, <span>Rice</span>, <span>Tomatoe</span>
                                                </p>
                                            </div>
                                            <div class="one-forth">
                                                <span class="price">$29</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section testimony-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Guests Says</span>
                    <h2>Our Satisfied Guests says</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel owl-carousel ftco-owl">
                        <div class="item text-center">
                            <div class="testimony-wrap p-4 pb-5">
                                <div class="user-img mb-4" style="background-image: url(images/person_1.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                                </div>
                                <div class="text">
                                    <p class="star-rate"><span class="icon-star"></span><span
                                            class="icon-star"></span><span class="icon-star"></span><span
                                            class="icon-star"></span><span class="icon-star-half-full"></span></p>
                                    <p class="mb-5">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Dennis Green</p>
                                    <span class="position">Guests from Italy</span>
                                </div>
                            </div>
                        </div>
                        <div class="item text-center">
                            <div class="testimony-wrap p-4 pb-5">
                                <div class="user-img mb-4" style="background-image: url(images/person_2.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                                </div>
                                <div class="text">
                                    <p class="star-rate"><span class="icon-star"></span><span
                                            class="icon-star"></span><span class="icon-star"></span><span
                                            class="icon-star"></span><span class="icon-star-half-full"></span></p>
                                    <p class="mb-5">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Dennis Green</p>
                                    <span class="position">Guests from Italy</span>
                                </div>
                            </div>
                        </div>
                        <div class="item text-center">
                            <div class="testimony-wrap p-4 pb-5">
                                <div class="user-img mb-4" style="background-image: url(images/person_3.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                                </div>
                                <div class="text">
                                    <p class="star-rate"><span class="icon-star"></span><span
                                            class="icon-star"></span><span class="icon-star"></span><span
                                            class="icon-star"></span><span class="icon-star-half-full"></span></p>
                                    <p class="mb-5">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Dennis Green</p>
                                    <span class="position">Guests from Italy</span>
                                </div>
                            </div>
                        </div>
                        <div class="item text-center">
                            <div class="testimony-wrap p-4 pb-5">
                                <div class="user-img mb-4" style="background-image: url(images/person_1.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                                </div>
                                <div class="text">
                                    <p class="star-rate"><span class="icon-star"></span><span
                                            class="icon-star"></span><span class="icon-star"></span><span
                                            class="icon-star"></span><span class="icon-star-half-full"></span></p>
                                    <p class="mb-5">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Dennis Green</p>
                                    <span class="position">Guests from Italy</span>
                                </div>
                            </div>
                        </div>
                        <div class="item text-center">
                            <div class="testimony-wrap p-4 pb-5">
                                <div class="user-img mb-4" style="background-image: url(images/person_1.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                                </div>
                                <div class="text">
                                    <p class="star-rate"><span class="icon-star"></span><span
                                            class="icon-star"></span><span class="icon-star"></span><span
                                            class="icon-star"></span><span class="icon-star-half-full"></span></p>
                                    <p class="mb-5">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Dennis Green</p>
                                    <span class="position">Guests from Italy</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Blog</span>
                    <h2>Recent Blog</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="carousel1 owl-carousel ftco-owl">
                    <div class="item">
                        <div class="blog-entry">
                            <a href="blog-single.html" class="block-20"
                               style="background-image: url('images/image_5.jpg');">
                            </a>
                            <div class="text p-4 d-block">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                        blind texts</a></h3>
                                <div class="meta">
                                    <div><a href="#">July 12, 2018</a></div>
                                    <div><a href="#">Admin</a></div>
                                    <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="blog-entry" data-aos-delay="100">
                            <a href="blog-single.html" class="block-20"
                               style="background-image: url('images/image_6.jpg');">
                            </a>
                            <div class="text p-4">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                        blind texts</a></h3>
                                <div class="meta">
                                    <div><a href="#">July 12, 2018</a></div>
                                    <div><a href="#">Admin</a></div>
                                    <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="blog-entry" data-aos-delay="200">
                            <a href="blog-single.html" class="block-20"
                               style="background-image: url('images/image_7.jpg');">
                            </a>
                            <div class="text p-4">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                        blind texts</a></h3>
                                <div class="meta">
                                    <div><a href="#">July 12, 2018</a></div>
                                    <div><a href="#">Admin</a></div>
                                    <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="blog-entry" data-aos-delay="200">
                            <a href="blog-single.html" class="block-20"
                               style="background-image: url('images/image_8.jpg');">
                            </a>
                            <div class="text p-4">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                        blind texts</a></h3>
                                <div class="meta">
                                    <div><a href="#">July 12, 2018</a></div>
                                    <div><a href="#">Admin</a></div>
                                    <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="blog-entry" data-aos-delay="200">
                            <a href="blog-single.html" class="block-20"
                               style="background-image: url('images/image_9.jpg');">
                            </a>
                            <div class="text p-4">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                        blind texts</a></h3>
                                <div class="meta">
                                    <div><a href="#">July 12, 2018</a></div>
                                    <div><a href="#">Admin</a></div>
                                    <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container-fluid section-event">
            <div class="row no-gutters justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Join Event</span>
                    <h2>Our Events</h2>
                </div>
            </div>
            <div class="row d-flex no-gutters">
                <div class="col-md-6 event-big-img" style="background-image: url(images/event.jpg);"></div>
                <div class="col-md-6 event-wrap">
                    <div class="event mb-5 ftco-animate">
                        <div class="text">
                            <p class="meta p-2 text-center">
                                <span class="day">12</span>
                                <span class="mos">July</span>
                                <span class="year">2018</span>
                            </p>
                            <h3><a href="event.html">Big summer meetups</a></h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                there live the blind texts</p>
                            <p>
                                <a href="#" class="btn btn-primary">Join event</a>
                                <a href="#" class="btn btn-primary btn-outline-primary">See details</a>
                            </p>
                        </div>
                    </div>
                    <div class="event mb-5 ftco-animate">
                        <div class="text">
                            <p class="meta p-2 text-center">
                                <span class="day">12</span>
                                <span class="mos">July</span>
                                <span class="year">2018</span>
                            </p>
                            <h3><a href="event.html">Big summer meetups</a></h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                there live the blind texts</p>
                            <p>
                                <a href="#" class="btn btn-primary">Join event</a>
                                <a href="#" class="btn btn-primary btn-outline-primary">See details</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
