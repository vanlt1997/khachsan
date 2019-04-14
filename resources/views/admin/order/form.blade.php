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
            <h3 class="text-center">{{isset($order) ? 'Edit Order '.$order['id'] : 'Add Order'}}</h3>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="form-group col-md-12">
                <div class="row col-md-12">
                    <div class="col-md-2">
                        <label for="user_name">Choose user</label>
                    </div>
                    <div class="col-md-10">
                        <select class="form-control select-user" name="selectUsers" id="selectUser">
                            <option value="">Choose user</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->email}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
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
                                    <option value="{{$item->id}}">{{$item->name}}</option>
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
                            <select name="payment" class="form-control">
                                @foreach($payments as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-2">
                            <label for="typeRoom">Type Room</label>
                        </div>
                        <div class="col-md-10 row">
                            <div class="col-md-3">
                                Type Room <select name="typeRooms" class="form-control" id="selectTypeRoom">
                                    <option value="">--Select Type Room--</option>
                                @foreach($typeRooms as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                From <input type="date" name="startDate" class="form-control">
                            </div>
                            <div class="col-md-3">
                                To <input type="date" name="endDate" class="form-control">
                            </div>
                            <div class="col-md-3">
                                Number <input type="number" name="number_people" class="form-control">
                            </div>
                            <div class="col-md-12 mt-2">
                                <button type="button" class="btn btn-outline-primary btn-sm" id="btnSearchRoom">Search</button>
                                <button type="button" class="btn btn-outline-success btn-sm" id="btnCalculate">Calculate</button>
                            </div>
                            <div class="row col-md-12" id="showRoom">
                                <input type="text" name="nameRoom" id="nameRoom" hidden>
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

        $('#selectUser').on('change', function () {
           var userID = $(this).val();
           console.log(userID);
           if (userID !== null){
               $.ajax({
                   url: '{{route('admin.orders.select-user')}}',
                   type: 'POST',
                   contentType: 'application/json,charset=utf8',
                   data: JSON.stringify({'userID': userID}),
                   success: function (data) {
                        $('[name=name]').val(data.name);
                        $('[name=email]').val(data.email);
                        $('#sex option[value='+data.sex+']').attr('selected', 'selected');
                        $('[name=phone]').val(data.phone);
                        $('[name=address]').val(data.address);

                   }
               })
           }
        });

        $('#btnSearchRoom').on('click', function () {
            let typeRoom = $('#selectTypeRoom').val();
            let startDate = $('[name=startDate]').val();
            let endData = $('[name=endDate]').val();
            let number_people = $('[name=number_people]').val();
            $.ajax({
                url: '{{route('admin.orders.search-room')}}',
                type: 'POST',
                contentType: 'application/json,charset=utf8',
                data: JSON.stringify({'typeRoom': typeRoom , 'startDate': startDate, 'endDate': endData, 'number_people': number_people}),
                success: function (data) {
                    var html = '';
                    $('.img-modal').remove();
                    if (data == 0) {
                        html +='<p class="mb-4 text-danger img-modal">Can\'t room for you !</p>'
                    } else {
                        data.forEach(function (room) {
                            html += '<div class="col-md-2 text-center text-danger p-3 m-3 style-room img-modal" ' +
                                'id="'+ room.room_name +'" onclick="chooseRoom('+room.room_name+')"><p>'+room.type_room_name
                                +'</p><p>Room '+room.room_name+'</p><p>'+room.number_people+' people/room</p><p>$' +room.price+
                                '/day</p>  </div>'

                        });
                    }
                    $('#showRoom').append(html);
                }

            })
        });

    </script>
@endpush

