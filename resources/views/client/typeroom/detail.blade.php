@extends('layouts.client')
@section('title','Detail Room')
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
                                            href="{{route('client.index')}}">Home</a></span> <span class="mr-2"><a href="{{route('client.typerooms.index')}}">Rooms </a></span>  <span> {{$typeRoom->name}}</span></p>
                                <h1 class="mb-3">{{$typeRoom->name}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </section>
@endsection
@section('content')
    <section class="ftco-section bg-light" id="detailTrpeRoom">
        <div class="container">
            <div class="col-md-12">
                <div class="ftco-footer-widget mb-4 text-center header-title">
                    <h2 class="text-danger">{{$typeRoom->name}}</h2>
                    <h5>All rooms in the hotel are designed and decorated in a modern and luxurious style with the most
                        modern facilities to create a cozy,
                        luxurious and impressive space.</h5>
                </div>
            </div>

            @include('common.client.search-room')

            <div class="col-md-12 ftco-animate">
                <div class="carousel-room owl-carousel">
                    @foreach($typeRoom->images as $image)
                        <div class="item">
                            <div class="room-wrap">
                                <a href="{{route('client.typerooms.detail', $typeRoom->id)}}" class="room-img"
                                   style="background-image: url('{{asset("images/admin/library-images/$image->url")}}');"></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="row" style="margin: 50px 0">
                <div class="col-md-4">
                    <h2><a href="{{route('client.typerooms.detail', $typeRoom->id)}}">{{$typeRoom->name}}</a></h2>
                    <table>
                        <thead>
                            <tr>
                                <th width="50px">Price</th>
                                <td class="text-danger">${{$typeRoom->price}}/day</td>
                            </tr>
                            <tr>
                                <th width="50px">Sale</th>
                                <td class="text-danger">{{$typeRoom->sale != 0 ?$typeRoom->sale.' %': '0 %'}}</td>
                            </tr>
                        </thead>
                    </table>
                    <a href="{{route('client.typerooms.booking', $typeRoom->id)}}" class="btn btn-primary btn-sm">Booking Now</a>
                </div>
                <div class="col-md-8">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>Max People</th>
                            <td>{{$typeRoom->people}}</td>
                        </tr>
                        <tr>
                            <th>Number Bed </th>
                            <td>{{$typeRoom->bed}}</td>
                        </tr>
                        <tr>
                            <th>Number Extra_bed</th>
                            <td>{{$typeRoom->extra_bed}}</td>
                        </tr>
                        <tr>
                            <th>Acreage</th>
                            <td>{{$typeRoom->acreage }}m <sup>2</sup></td>
                        </tr>
                        <tr>
                            <th>View</th>
                            <td>{{$typeRoom->view}}</td>
                        </tr>
                        <tr>
                            <th>Devices</th>
                            <td>
                                <ul>
                                    @foreach($typeRoom->devices as $device)
                                        <li>{{$device->name}}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{!! $typeRoom->description !!}</td>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            @include('admin.typeroom.info-detail-typeroom');
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).on("ready",function () {
            $('html, body').animate({
                scrollTop: $("#detailTrpeRoom").offset().top
            }, 1000);
        });
    </script>
@endpush
