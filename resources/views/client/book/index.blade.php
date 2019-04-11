@extends('layouts.client')
@section('title','Booking')
@section('slidebar')
    <section class="home-slider owl-carousel">
        @if($slidebars->count() > 0)
            @foreach($slidebars as $slidebar)
                <div class="slider-item" style="background-image: url('images/slidebars/{{$slidebar->url}}');">
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
    <section class="ftco-section contact-section" id="Booking">
        <div class="container bg-light">
            <div class="row" id="headerBooking">
                <div class="col-md-10">
                    <h2 class="text-danger">Booking</h2>
                    <p class="text-warning mt-2">( Please enter all the infomation below !)</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <a href="{{route('client.booking.confirm')}}" class="btn btn-sm btn-outline-success">Payment</a>
                    <a href="{{route('client.booking.delete-all')}}" class="btn btn-sm btn-danger">Remove all</a>
                </div>
            </div>
            <div class="row col-md-12">
                <div class="row col-md-12" id="formBooking">
                    @foreach($cart->typeRooms as $typeRoom)
                        <div class="row mb-5" style="border-bottom: 2px solid #fff">
                            <div class="row col-md-12 mb-5">
                                <div class="row col-md-12 name-typeRoom">
                                    <h5 class="pl-3">Type : {{$typeRoom['typeRoom']->name}}</h5>
                                </div>
                                <div class="row col-md-12">
                                    <div class="col-md-3">
                                        <label for="startDate">
                                            From <input type="date" name="startDate" value="{{$typeRoom['startDate']}}"
                                                        class="form-control">
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="endDate">
                                            To <input type="date" name="endDate" value="{{$typeRoom['endDate']}}"
                                                      class="form-control">
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="number_people">
                                            People <input type="number" name="number_people"
                                                          value="{{$typeRoom['number_people']}}" class="form-control">
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="number_people">
                                            Room <input type="number_room" name="number_room"
                                                        value="{{$typeRoom['number_room']}}" class="form-control">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <table class="table" id="tableBooking">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Price/day</th>
                                        <th>Sale (%)</th>
                                        <th>Total</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <td>
                                            <img src="{{asset('images/admin/library-images')}}/{{$typeRoom['typeRoom']->images->first()['url']}}"
                                                 width="100px" height="125px">
                                        </td>
                                        <td>${{$typeRoom['price']}}</td>
                                        <td>{{$typeRoom['sale']}}</td>
                                        <td>${{$typeRoom['total']}}</td>
                                        <td class="text-right">
                                            <a class="btn btn-sm btn-outline-primary"
                                               href="{{route('client.booking.edit', $typeRoom['typeRoom']->id)}}">Edit</a>
                                            <a class="btn btn-sm btn-outline-danger"
                                               href="{{route('client.booking.delete', $typeRoom['typeRoom']->id)}}">Remove</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row col-md-12">
                <div class="col-md-12 mb-5 text-left">
                    <h5 class="text-dark">Total : ${{$cart->paymentTotal}}</h5>
                    <h5 class="text-dark">Promotion : 0</h5>
                    <h5 class="text-dark">Payment Total : 0</h5>
                </div>
                <div class="col-md-12 text-left">
                    <a href="{{route('client.booking.confirm')}}" class="btn btn-sm btn-outline-success">Payment</a>
                </div>

            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).on("ready", function () {
            $('html, body').animate({
                scrollTop: $("#Booking").offset().top
            }, 1000);
        });
    </script>
@endpush
