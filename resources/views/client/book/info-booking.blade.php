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
                    <h3 class="text-danger">Infomation User</h3>
                </div>
            </div>
            <form method="post" class="row col-md-12" id="formConfirm">
                <div class=" row col-md-12">
                        <div class="col-md-6">
                            <div class="form-group row col-md-12">
                                <div class="col-md-2">
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                </div>
                                @if($errors->has('name'))
                                    <p class="text-danger"><i
                                                class="fa fa-exclamation-circle"></i> {{$errors->first('name')}}</p>
                                @endif
                            </div>
                            <div class="form-group row col-md-12">
                                <div class="col-md-2">
                                    <label for="email">Email</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                </div>
                                @if($errors->has('email'))
                                    <p class="text-danger"><i
                                                class="fa fa-exclamation-circle"></i> {{$errors->first('email')}}</p>
                                @endif
                            </div>
                            <div class="form-group row col-md-12">
                                <div class="col-md-2">
                                    <label for="phone">Phone</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="number" name="phone" class="form-control" placeholder="Number">
                                </div>
                                @if($errors->has('phone'))
                                    <p class="text-danger"><i
                                                class="fa fa-exclamation-circle"></i> {{$errors->first('phone')}}</p>
                                @endif
                            </div>
                            <div class="form-group row col-md-12">
                                <div class="col-md-2">
                                    <label for="sex">Sex</label>
                                </div>
                                <div class="col-md-10">
                                    <select name="sex" class="form-control" id="sex">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row col-md-12">
                                <div class="col-md-2">
                                    <label for="address">Address</label>
                                </div>
                                <div class="col-md-10">
                                    <textarea name="address" class="form-control" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-primary">Payment Method</h5>
                            <div class="form-group row col-md-12">
                                @foreach($payments as $payment)
                                    <div class="col-md-12">
                                        <label for="payment">
                                            <input type="radio" name="payment" value="{{$payment->id}}" class="mr-2"> {{$payment->name}}
                                        </label>
                                    </div>
                                @endforeach
                                @if($errors->has('payment'))
                                    <p class="text-danger"><i
                                                class="fa fa-exclamation-circle"></i> {{$errors->first('payment')}}</p>
                                @endif
                            </div>
                        </div>

                </div>
                <div class="col-md-12">
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
                                <td>$ {{$card->promotion}}</td>
                            </tr>
                            <tr class="text-danger">
                                <td colspan="7" class="text-right">Payment Total</td>
                                <td>$ {{$card->paymentTotal}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <a href="{{route('client.booking')}}" class="btn btn-sm btn-outline-primary">Back</a>
                    <button class="btn btn-sm btn-outline-success" type="submit">Confirm</button>
                </div>
            </form>
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
