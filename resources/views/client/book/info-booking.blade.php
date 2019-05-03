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
                    <h3 class="text-danger">Information User</h3>
                </div>
            </div>
            <div class="row col-md-12">
                <form method="post" class="col-md-7" id="formConfirm">
                    <div class=" row col-md-12">
                        <div class="col-md-12">
                            <div class="form-group row col-md-12">
                                <div class="col-md-2">
                                    <label for="name">Name</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{Auth::user()->name}}">
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
                                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{Auth::user()->email}}">
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
                                    <input type="number" name="phone" class="form-control" placeholder="Number" value="{{Auth::user()->phone}}">
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
                                        <option value="Male" @if(Auth::user()->sex === 'Male') selected @endif>Male</option>
                                        <option value="Female" @if(Auth::user()->sex === 'Female') selected @endif>Female</option>
                                        <option value="Other" @if(Auth::user()->sex === 'Other') selected @endif>Other</option>
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
                        <div class="col-md-12">


                            <div class="form-group row col-md-12">
                                <div class="col-md-2">
                                    <label for="payment_method">Payment Method</label>
                                </div>
                                <div class="col-md-10">
                                    @foreach($payments as $payment)
                                        <div class="col-md-12">
                                            <label for="payment">
                                                <input type="radio" name="payment" value="{{$payment->id}}"
                                                       class="mr-2" onclick="changeCard({{$payment->id}})"> {{$payment->name}}
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
                    </div>
                    <div class="col-md-12">
                        <a href="{{route('client.booking')}}" class="btn btn-sm btn-outline-primary">Back</a>
                        <button class="btn btn-sm btn-outline-success" id="btnConfirm">Confirm</button>
                    </div>
                </form>
                <div class="col-md-5" id="numberCard" hidden>
                    <div class="form-row mt-5">
                        <div id="card-element" class="col-md-12">
                        </div>
                        <div id="card-errors" role="alert"></div>
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
        </div>
    </section>
@endsection
@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script type="text/javascript" src="{{asset('js/client/checkout.js')}}"></script>
    <script>
        $(document).on("ready", function () {
            $('html, body').animate({
                scrollTop: $("#confirm").offset().top
            }, 1000);
        });
        function changeCard(paymentId) {
            if (paymentId !== 1) {
                $('#numberCard').removeAttr('hidden')
            } else {
                $('#numberCard').attr('hidden', true)
            }
        }
    </script>
@endpush
