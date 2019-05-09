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
            <div class="row" id="headerBooking">
                <div class="col-md-12">
                    <h3 class="text-danger">Confirm booking room</h3>
                </div>
            </div>
            <div class="row">
                <h5 class="text-primary">Information Customer</h5>
                <div class="col-md-12 row">
                    <div class="col-md-2">Name</div>
                    <div class="col-md-10">{{$info['name']}}</div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-2">Email</div>
                    <div class="col-md-10">{{$info['email']}}</div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-2">Phone</div>
                    <div class="col-md-10">{{$info['phone']}}</div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-2">Payment Method</div>
                    <div class="col-md-10">{{$info['payment']->name}}</div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-2">Sex</div>
                    <div class="col-md-10">{{$info['sex']}}</div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-2">Address</div>
                    <div class="col-md-10">{{$info['address']}}</div>
                </div>
            </div>
            <div class="row">
                <h5 class="text-primary">Information Room</h5>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Images</th>
                        <th>Name</th>
                        <th>Checkin</th>
                        <th>Checkout</th>
                        <th>Number people</th>
                        <th>Price</th>
                        <th>Sale (%)</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($card->typeRooms as $typeRoom)
                        <tr>
                            <td>
                                <img src="{{asset('images/admin/library-images')}}/{{$typeRoom['typeRoom']->images->first()['url']}}"
                                     width="100px" height="125px">
                            </td>
                            <td>{{$typeRoom['typeRoom']->name}}</td>
                            <td>{{$typeRoom['startDate']}}</td>
                            <td>{{$typeRoom['endDate']}}</td>
                            <td>{{$typeRoom['number_people']}}</td>
                            <td>$ {{$typeRoom['typeRoom']->price}}</td>
                            <td>{{$typeRoom['typeRoom']->sale ?? 0}} %</td>
                            <td>$ {{$typeRoom['total']}}</td>
                        </tr>
                    @endforeach
                    <tr class="text-danger">
                        <td colspan="7" class="text-right">Total</td>
                        <td>$ {{$card->total}}</td>
                    </tr>
                    <tr class="text-danger">
                        <td colspan="7" class="text-right">Promotion</td>
                        <td>$ {{$card->promotion ?? 0}}</td>
                    </tr>
                    <tr class="text-danger">
                        <td colspan="7" class="text-right">Payment Total</td>
                        <td>$ {{$card->paymentTotal}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <a href="{{route('client.booking.next')}}" class="btn btn-sm btn-outline-primary">Back</a>
                <a href="{{route('client.booking.finish')}}" class="btn btn-sm btn-outline-success">Finish</a>
            </div>
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
