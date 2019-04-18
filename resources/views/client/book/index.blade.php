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
    @if(isset($card->typeRooms))
        <section class="ftco-section contact-section" id="Booking">
            <div class="container bg-light">
            <div class="row" id="headerBooking">
                <div class="col-md-10">
                    <h2 class="text-danger">Booking</h2>
                    <p class="text-warning mt-2">( Please enter all the infomation below !)</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 row">
                    <form method="post" class="row col-md-12" action="{{route('client.booking.check')}}">
                        @csrf
                        <div class="col-md-3">
                            <label for="promotion">Promotion Code</label>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="promotion" id="promotion" class="form-control" placeholder="Promotion" value="{{Session::get('code')['code'] ?? null}}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-sm btn-outline-info">Check code</button>
                        </div>
                        @if(Session::has('checkCode'))
                            <p class="text-danger col-md-12">{{Session::get('checkCode')}}</p>
                        @endif
                    </form>
                </div>
                <div class="col-md-3 text-right">
                    <a href="{{route('client.booking.next')}}" class="btn btn-sm btn-outline-success">Next</a>
                    <a href="{{route('client.booking.delete-all')}}" class="btn btn-sm btn-danger">Remove all</a>
                </div>
                <div class="col-md-12">
                    <p id="messCheck" class="text-danger"></p>
                </div>
            </div>
            <div class="row col-md-12 mt-5">
                <div class="row col-md-12" id="formBooking">
                    @foreach($card->typeRooms as $typeRoom)
                    <form method="post" action="{{route('client.booking.edit', $typeRoom['typeRoom']->id)}}">
                        @csrf
                        <div class="row mb-5" style="border-bottom: 2px solid #fff">
                            <div class="row col-md-12 mb-5">
                                <div class="row col-md-12 name-typeRoom">
                                    <h5 class="pl-3 text-success">Type : {{$typeRoom['typeRoom']->name}}</h5>
                                </div>
                                <div class="row col-md-12">
                                    <div class="col-md-3">
                                        <input type="number" value="{{$typeRoom['typeRoom']->id}}"
                                               class="form-control" hidden name="typeRoom">
                                        <label for="startDate">
                                            From <input type="date" name="startDate" value="{{$typeRoom['startDate']}}"
                                                        class="form-control">
                                        </label>
                                        @if($errors->has('startDate') && !$typeRoom['startDate'])
                                            <p class="text-danger"><i
                                                        class="fa fa-exclamation-circle"></i> {{$errors->first('startDate')}}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <label for="endDate">
                                            To <input type="date" name="endDate" value="{{$typeRoom['endDate']}}"
                                                      class="form-control">
                                        </label>
                                        @if($errors->has('endDate') && !$typeRoom['endDate'])
                                            <p class="text-danger"><i
                                                        class="fa fa-exclamation-circle"></i> {{$errors->first('endDate')}}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <label for="number_people">
                                            People <input type="number" name="number_people"
                                                          value="{{$typeRoom['number_people']}}" class="form-control">
                                        </label>
                                        @if($errors->has('number_people'))
                                            <p class="text-danger"><i
                                                        class="fa fa-exclamation-circle"></i> {{$errors->first('number_people')}}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-4 mt-4 text-right pt-2">
                                        <button class="btn btn-sm btn-outline-primary" type="submit"
                                                href="{{route('client.booking.edit', ['typeRoom' => $typeRoom['typeRoom']->id])}}">Edit</button>
                                        <a class="btn btn-sm btn-outline-danger"
                                           href="{{route('client.booking.delete', $typeRoom['typeRoom']->id)}}">Remove</a>
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
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </form>

                @endforeach
                </div>
            </div>
            <div class="row col-md-12">
                <div class="col-md-12 mb-5 text-left">
                    <h5 class="text-dark">Total : ${{$card->total}}</h5>
                    <h5 class="text-dark">Promotion : ${{$card->promotion}}</h5>
                    <h5 class="text-dark">Payment Total : ${{$card->paymentTotal}}</h5>
                </div>
                <div class="col-md-12 text-left">
                    <a href="{{route('client.booking.next')}}" class="btn btn-sm btn-outline-success">Next</a>
                </div>

            </div>
        </div>
    </section>
    @else
        <section class="ftco-section contact-section" id="Booking">
            <div class="container bg-light">
                <div class="row" id="headerBooking">
                    <div class="col-md-10">
                        <h2 class="text-danger">You haven't Room .Please, booking room !</h2>
                    </div>
                </div>
            </div>
        </section>
    @endif
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
