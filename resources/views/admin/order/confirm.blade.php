@extends('layouts.admin')
@section('title',"Order" )
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/order.css')}}">
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
            <h4 class="text-primary col-md-12 mt-5 mb-5" id="title-info">Infomition Type Room</h4>
            @if(isset($card))
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($card->typeRooms as $typeRoom)
                        <tr id="order-{{$typeRoom['typeRoom']->id}}">
                            <td>
                                <select name="typeRoom" class="form-control" id="selectTypeRoom">
                                    @foreach($typeRooms as $item)
                                        <option value="{{$item->id}}" @if($item->id === $typeRoom['typeRoom']->id) selected @endif>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="price" id="price" value="{{$typeRoom['price']}}" class="form-control" readonly>
                            </td>
                            <td>
                                <input type="text" name="sale" id="sale" value="{{$typeRoom['sale']}}" class="form-control" readonly>
                            </td>
                            <td>
                                <input type="text" name="number_people" id="number_people" value="{{$typeRoom['number_people']}}" class="form-control">
                            </td>
                            <td>
                                <input type="date" name="startDate" id="startDate" value="{{$typeRoom['startDate']}}" class="form-control">
                            </td>
                            <td>
                                <input type="date" name="endDate" id="endDate" value="{{$typeRoom['endDate']}}" class="form-control">
                            </td>
                            <td>{{$typeRoom['total']}}</td>
                            <td>
                                <button onclick="editTypeRoom('{{$typeRoom['typeRoom']->id}}')" type="button" class="btn btn-sm btn-outline-primary mb-2"><i class="fa fa-pencil-square-o"></i></button>
                                <button onclick="deleteTypeRoom('{{$typeRoom['typeRoom']->id}}')" type="button" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash-o"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8">
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
                        <td colspan="7" class="text-right">Total</td>
                        <td id="total">$ {{$card->total}}</td>
                    </tr>
                    <tr>
                        <td colspan="7" class="text-right">Promotion</td>
                        <td id="promotion">$ {{$card->promotion}}</td>
                    </tr>
                    <tr>
                        <td colspan="7" class="text-right">Payment Total</td>
                        <td id="paymentTotal">$ {{$card->paymentTotal}}</td>
                    </tr>
                </tbody>
            </table>
                <a href="{{route('admin.orders.finish')}}" class="btn btn-sm btn-outline-success  mr-3" id="btnFinish">Finish</a>
            @endif
            <a href="{{route('admin.orders.create')}}" class="btn btn-sm btn-outline-info">Back</a>


        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function deleteTypeRoom(id) {
            if (id) {
                $.ajax({
                    url: '{{route('admin.orders.delete-booking')}}',
                    type: 'POST',
                    contentType: 'application/json;charset=utf8',
                    data : JSON.stringify({ 'id': id}),
                    success: function (data) {
                        location. reload(true);
                    }
                })
            }
        }
    </script>
@endpush

