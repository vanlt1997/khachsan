@extends('layouts.admin')
@section('title',"Edit Handled" )
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/order.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Confirm Edit Order</h3>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 row mt-5">
                <div class="col-md-2">Name</div>
                <div class="col-md-10">{{$order['info']['name']}}</div>
            </div>
            <div class="col-md-12 row">
                <div class="col-md-2">Email</div>
                <div class="col-md-10">{{$order['info']['email']}}</div>
            </div>
            <div class="col-md-12 row">
                <div class="col-md-2">Sex</div>
                <div class="col-md-10">{{$order['info']['sex']}}</div>
            </div>
            <div class="col-md-12 row">
                <div class="col-md-2">Phone</div>
                <div class="col-md-10">{{$order['info']['phone']}}</div>
            </div>
            <div class="col-md-12 row">
                <div class="col-md-2">Address</div>
                <div class="col-md-10">{{$order['info']['address']}}</div>
            </div>
            <div class="col-md-12 row">
                <div class="col-md-2">Payment method</div>
                <div class="col-md-10">{{$order['info']['payment']}}</div>
            </div>
        </div>
        <div class="row">
            <h4 class="text-primary col-md-12 mt-5 mb-5" id="title-info">Infomition Type Room</h4>
            @if(isset($order))
                <table class="table table-hover table-striped" id="card">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Sale (%)</th>
                        <th>People</th>
                        <th>Checkin</th>
                        <th>Checkout</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order['orders'] as $orderTypeRoom)
                        <tr>
                            <td>{{$orderTypeRoom['typeRoom']->name}}</td>
                            <td>{{$orderTypeRoom['typeRoom']->price}}</td>
                            <td>{{$orderTypeRoom['typeRoom']->sale}}</td>
                            <td>{{$orderTypeRoom['number_people']}}</td>
                            <td>{{$orderTypeRoom['start_date']}}</td>
                            <td>{{$orderTypeRoom['end_date']}}</td>
                            <td>{{$orderTypeRoom['total']}}</td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <ul class="text-info">
                                    @foreach($orderTypeRoom['rooms'] as $room)
                                        <li>Room {{$room->name}}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="text-danger">
                        <td colspan="2" class="text-right">Total Old</td>
                        <td id="total">$ {{$order['orderOld']->total}}</td>
                        <td colspan="3" class="text-right">Total New</td>
                        <td id="total">$ {{$order['total']}}</td>
                    </tr>
                    <tr class="text-danger">
                        <td colspan="2" class="text-right">Promotion</td>
                        <td id="promotion">$ {{$order['promotion']}}</td>
                        <td colspan="3" class="text-right">Promotion</td>
                        <td id="promotion">$ {{$order['promotion']}}</td>
                    </tr>
                    <tr class="text-danger">
                        <td colspan="2" class="text-right">Payment Total Old</td>
                        <td id="paymentTotal">$ {{$order['orderOld']->payment_total}}</td>
                        <td colspan="3" class="text-right">Payment Total New</td>
                        <td id="paymentTotal">$ {{$order['paymentTotal']}}</td>
                    </tr>
                    <tr class="text-danger">
                        <th colspan="6" class="text-right">Add Payment</th>
                        <th id="paymentTotal">$ {{$order['paymentNew']}}</th>
                    </tr>
                </tbody>
            </table>
                <a href="{{route('admin.orders.handled.finish')}}" class="btn btn-sm btn-outline-info  mr-3" id="btnFinish">Finish</a>
            @endif
            <a href="{{route('admin.orders.handled.edit', $order['orderOld']->id)}}" class="btn btn-sm btn-outline-success">Back</a>
        </div>
    </div>
@endsection

