@extends('layouts.admin')
@section('title',"Order Handled" )
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/order.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">{{isset($order) ? 'Edit Order '.$order['id'] : 'Add Order'}}</h3>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <form method="post" role="form" class="form-horizontal col-md-12">
                @csrf
                <hr>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-2">
                            <label for="name">Name <span>&hercon;</span></label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control"
                                   placeholder="Name" value="{{ $order->user->name?? null}}">
                            <div class="error-content">
                                @if($errors->has('name'))
                                    <p class="text-danger"><i
                                                class="fa fa-exclamation-circle"></i> {{$errors->first('name')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-2">
                            <label for="email">Email <span>&hercon;</span></label>
                        </div>
                        <div class="col-md-10">
                            <input type="email" name="email" class="form-control"
                                   placeholder="Email" value="{{$order->user->email?? null}}">
                            <div class="error-content">
                                @if($errors->has('email'))
                                    <p class="text-danger"><i
                                                class="fa fa-exclamation-circle"></i> {{$errors->first('email')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-2">
                            <label for="sex">Sex</label>
                        </div>
                        <div class="col-md-10">
                            <select name="sex" class="form-control" id="sex">
                                <option value="Male" @if(isset($order->user) && $order->user->sex === 'Male') selected @endif>Male</option>
                                <option value="Female" @if(isset($order->user) && $order->user->sex === 'Female') selected @endif>Female</option>
                                <option value="Other" @if(isset($order->user) && $order->user->sex === 'Other') selected @endif>Other</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-2">
                            <label for="phone">Phone</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="phone" class="form-control" value="{{$order->user->phone ?? null}}" id="phone" placeholder="Phone">
                            <div class="error-content">
                                @if($errors->has('phone'))
                                    <p class="text-danger"><i
                                                class="fa fa-exclamation-circle"></i> {{$errors->first('phone')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-2">
                            <label for="address">Address</label>
                        </div>
                        <div class="col-md-10">
                            <textarea name="address" class="form-control"  cols="30" rows="5">
                                {!! $order->user->address ?? null !!}
                            </textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-2">
                            <label for="status">Status</label>
                        </div>
                        <div class="col-md-10">
                            <select name="status" class="form-control">
                                @foreach($status as $item)
                                    <option value="{{$item->id}}" @if(isset($order) && $order->status_order_id === $item->id) selected @endif >{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-2">
                            <label for="payment">Payment</label>
                        </div>
                        <div class="col-md-10">
                            <select name="payment_method" class="form-control">
                                @foreach($payments as $item)
                                    <option value="{{$item->name}}" @if(isset($order) && $order->payment_method === $item->name) selected @endif>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-2">
                            <label for="payment">Promotion</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="promotion" class="form-control" id="promotion" value="{{$order->promotion}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-2">
                            <label for="payment">Information Type Room</label>
                        </div>
                        <div class="col-md-10 row">
                            @foreach($infoTypeRooms as $typeRoom)
                                <div class="col-md-6">
                                    <ul class="text-danger">
                                        <li>{{$typeRoom->type_room_name}}
                                            <ul>
                                                <li>Free rooms : {{$typeRoom->total_room}}</li>
                                                <li>Number/Room : {{$typeRoom->number_people}}</li>
                                                <li>Price : {{$typeRoom->price}}</li>
                                                <li>Sale : {{$typeRoom->sale}} %</li>
                                                <li>acreage : {{$typeRoom->acreage ?? 0}} m <sup>2</sup></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-2">
                            <label for="typeRoom">Type Room</label>
                        </div>
                        <div class="col-md-10 row">
                            @foreach($order->orderTypeRooms as $orderTypeRoom)
                                <div class="col-md-3">
                                    Type Room <input type="text" value="{{$orderTypeRoom->typeRoom->name}}" readonly class="form-control typeRoom">
                                </div>
                                <div class="col-md-3">
                                    From <input type="date" name="startDate{{$orderTypeRoom->type_room_id}}" class="form-control" value="{{$orderTypeRoom->start_date ?? null}}">
                                </div>
                                <div class="col-md-3">
                                    To <input type="date" name="endDate{{$orderTypeRoom->type_room_id}}" class="form-control" value="{{$orderTypeRoom->end_date ?? null}}" >
                                </div>
                                <div class="col-md-3">
                                    Number <input type="number" name="number_people{{$orderTypeRoom->type_room_id}}" class="form-control" value="{{$orderTypeRoom->number_people ?? 0}}">
                                </div>
                                <div class="col-md-12 mt-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="searchRoom('{{$orderTypeRoom->type_room_id}}')">Search</button>
                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="saveRoom({{$orderTypeRoom->type_room_id}})">Save</button>
                                </div>
                                <div class="row col-md-12" id="messageErrorSearch{{$orderTypeRoom->type_room_id}}">

                                </div>
                                <div class="row col-md-12" id="showRoom{{$orderTypeRoom->type_room_id}}">

                                    {{--Show room is choosed--}}
                                    @foreach($orderTypeRoom->orderDetails as $orderDetail)
                                        <div class="col-md-2 text-center text-danger p-3 m-3 style-room img-modal  room-show"
                                             onclick="chooseRoom('{{$orderDetail->room->name}}')"
                                             data-content="{{$orderDetail->room->name}}"
                                             id="{{$orderDetail->room->name}}">
                                            <p>Room {{$orderDetail->room->name}}</p>
                                            <p>{{$orderTypeRoom->typeRoom->name}}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                                <input type="text" name="nameRoom"  id="nameRoom" hidden>
                                <div class="row col-md-6">
                                    <div class="row col-md-12 text-danger">
                                        <h6 id="infoTotal">Total Old: $ {{$order->total ?? 0}}</h6>
                                    </div>
                                    <div class="row col-md-12 text-danger">
                                        <h6 id="infoTotal">Promotion : $ {{$order->promotion ?? 0}}</h6>
                                    </div>
                                    <div class="row col-md-12 text-danger">
                                        <h6 id="infoTotal">Payment Old : $ {{$order->payment_total ?? 0}}</h6>
                                    </div>
                                    <div class="col-md-12 mt-5">
                                        <button type="submit" class="btn btn-sm btn-outline-success">Next</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/admin/order.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        /*$(document).ready(function () {
            $('.select-user').select2();
        });*/
        function searchRoom(typeRoomId) {
            let typeRoom = typeRoomId;
            let startDate = $('[name=startDate'+typeRoomId+']').val();
            let endData = $('[name=endDate'+typeRoomId+']').val();
            let number_people = $('[name=number_people'+typeRoomId+']').val();
            let nameRooms = $('#nameRoom').val();
            let arrNameRooms= [];
            if (nameRooms) {
                arrNameRooms = nameRooms.split(',');
            }
            $('.error-'+typeRoom).remove();
            $('.img-modal-' + typeRoom).remove();
            $.ajax({
                url: '{{route('admin.orders.search-room')}}',
                type: 'POST',
                contentType: 'application/json;charset=utf8',
                data: JSON.stringify({'typeRoom': typeRoom , 'startDate': startDate, 'endDate': endData, 'number_people': number_people}),
                success: function (data) {
                    var html = '';
                    if (data == 0) {
                        $('.img-modal-' +typeRoom).remove();
                        html +='<p class="col-md-12 mt-4 text-danger error-'+ typeRoom +'">Can\'t room for you !</p>';
                        $('#messageErrorSearch'+typeRoom).append(html);
                    } else {
                        data.forEach(function (room) {
                            if(arrNameRooms) {
                                if(arrNameRooms.indexOf(room.name) === -1) {
                                    html += '<div class="col-md-2 text-center text-danger p-3 m-3 style-room img-modal img-modal-'+typeRoomId +'" ' +
                                        'id="'+ room.name +'" onclick="chooseRoom('+room.name+')"><p>Room '+room.name
                                        +'</q><p>'+ room.name_type_room +'</p></div>';
                                }
                            }
                        });
                        $('#showRoom'+typeRoom).append(html);
                    }
                }

            })
        }
    </script>
@endpush

