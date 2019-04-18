@extends('layouts.admin')
@section('title',"Order" )
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/order.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Confirm Order</h3>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 row mt-5">
                <div class="col-md-2">Name</div>
                <div class="col-md-10">{{$request->name}}</div>
            </div>
            <div class="col-md-12 row">
                <div class="col-md-2">Email</div>
                <div class="col-md-10">{{$request->email}}</div>
            </div>
            <div class="col-md-12 row">
                <div class="col-md-2">Sex</div>
                <div class="col-md-10">{{$request->sex}}</div>
            </div>
            <div class="col-md-12 row">
                <div class="col-md-2">Phone</div>
                <div class="col-md-10">{{$request->phone}}</div>
            </div>
            <div class="col-md-12 row">
                <div class="col-md-2">Address</div>
                <div class="col-md-10">{{$request->address}}</div>
            </div>
            <div class="col-md-12 row">
                <div class="col-md-2">Payment method</div>
                <div class="col-md-10">{{$request->payment_method}}</div>
            </div>
        </div>
        <div class="row">
            <h4 class="text-primary col-md-12 mt-5 mb-5">Infomition Type Room</h4>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Sale</th>
                        <th>People</th>
                        <th>Checkin</th>
                        <th>Checkout</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($card->typeRooms as $typeRoom)
                        <tr>
                            <td>{{$typeRoom['typeRoom']->name}}</td>
                            <td>$ {{$typeRoom['price']}}</td>
                            <td>{{$typeRoom['sale']}} %</td>
                            <td>{{$typeRoom['number_people']}}</td>
                            <td>{{$typeRoom['startDate']}}</td>
                            <td>{{$typeRoom['endDate']}}</td>
                            <td>$ {{$typeRoom['total']}}</td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                @if($typeRoom['rooms'])
                                    <ul>
                                        @foreach($typeRoom['rooms'] as $room)
                                            <li>Room {{$room->name}}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="6" class="text-right">Total</td>
                        <td>$ {{$card->total}}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">Promotion</td>
                        <td>$ {{$card->promotion}}</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-right">Payment Total</td>
                        <td>$ {{$card->paymentTotal}}</td>
                    </tr>
                </tbody>
            </table>
            <a href="{{route('admin.orders.create')}}" class="btn btn-sm btn-outline-info mr-3">Back</a>
            <a href="{{route('admin.orders.finish')}}" class="btn btn-sm btn-outline-success">Finish</a>

        </div>
    </div>
@endsection

