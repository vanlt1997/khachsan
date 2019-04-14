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
            <div class="col-md-12">
                <div class="ftco-footer-widget mb-4 text-center header-title">
                    <h2>Rooms & Price</h2>
                    <h5>All rooms in the hotel are designed and decorated in a modern and luxurious style with the most modern facilities to create a cozy,
                        luxurious and impressive space.</h5>
                </div>
                <div class="row">
                    @foreach($typeRooms as $typeRoom)
                        <div class="col-md-12 amenities d-md-flex ftco-animate" style="margin: 30px;">
                            <div class=" row one-half order-last text" style="width: 100%">
                                <div class="col-md-12 row">
                                    <div class="col-md-6"><h2 class="text-danger" style="border-bottom: 2px solid #0b93d5">{{$typeRoom->type_room_name}}</h2></div>
                                    <div class="col-md-6 text-right"><h3 class="text-danger">Have {{$typeRoom->total_room}} rooms</h3></div>
                                </div>
                                <div class="row col-md-12">
                                    <div class="col-md-3"><h5>Price</h5></div>
                                    <div class="col-md-9"><h5>$ {{$typeRoom->price}} /day</h5></div>
                                </div>
                                @if($typeRoom->sale !== null && $typeRoom->sale >0)
                                    <div class="row col-md-12">
                                        <div class="col-md-3"><h5>Sale</h5></div>
                                        <div class="col-md-9"><h5>{{$typeRoom->sale}} %</h5></div>
                                    </div>
                                @endif
                                <div class="row col-md-12">
                                    <div class="col-md-3"><h5>Number people</h5></div>
                                    <div class="col-md-9"><h5>{{$typeRoom->number_people}} people/room</h5></div>
                                </div>
                                <div class="row col-md-12">
                                    <div class="col-md-3"><h5>Acreage</h5></div>
                                    <div class="col-md-9"><h5>{{$typeRoom->acreage}} m<sup>2</sup></h5></div>
                                </div>
                                <div class="row col-md-12">
                                    <div class="col-md-3"><h5>Number bed</h5></div>
                                    <div class="col-md-9"><h5>{{$typeRoom->bed}} bed</h5></div>
                                </div>
                                <div class="row col-md-12">
                                    <div class="col-md-3"><h5>Number extra_bed</h5></div>
                                    <div class="col-md-9"><h5>{{$typeRoom->extra_bed}} bed</h5></div>
                                </div>
                                @if($typeRoom->view !== null)
                                    <div class="row col-md-12">
                                        <div class="col-md-3"><h5>View</h5></div>
                                        <div class="col-md-9"><h5>{{$typeRoom->view}}</h5></div>
                                    </div>
                                @endif
                                @if($typeRoom->description !== null)
                                    <div class="row col-md-12">
                                        <div class="col-md-3"><h5>Description</h5></div>
                                        <div class="col-md-9"><h5>{!! $typeRoom->description !!}}}</h5></div>
                                    </div>
                                @endif
                                <div class="col-md-12 booking text-right">
                                    <a href="{{route('client.typerooms.detail', $typeRoom->id)}}" class="btn btn-primary btn-xs">View...</a>
                                    <a href="{{route('client.typerooms.booking', ['typeRoom' => $typeRoom->id, 'startDate' => $request->startDate, 'endDate' => $request->endDate, 'number_people' => $request->number_people] )}}" class="btn btn-outline-danger btn-xs">Booking Now</a>
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
