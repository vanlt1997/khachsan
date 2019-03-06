@extends('layouts.admin')
@section('title','Rooms')
@section('css')
    <style>
        .detail-typeRoom{
            position: relative;
        }

        .detail-typeRoom>a{
            position: absolute;
            right: 0;
            top: 0;
        }
    </style>
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/device.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Rooms</h3>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row col-md-12">
            @foreach($typeRooms as $typeRoom)
                <div class="col-md-12 detail-typeRoom">
                    <h3>{{$typeRoom->name}}</h3>
                    <a href="{{route('admin.type-rooms.rooms.create',$typeRoom->id)}}" class="btn btn-outline-primary btn-sm right"><i class="fa fa-plus-circle"></i></a>
                </div>
                <div class="row col-md-12" style="margin-top: 50px">
                    @foreach($typeRoom->rooms as $room)
                        <div class="col-md-2">
                            <div class="room">
                                <div class="style-rooms @if($room->status_id === 1) bg-status-1
                                                                @elseif($room->status_id === 2) bg-status-2
                                                                @elseif($room->status_id === 3) bg-status-3
                                                                @else bg-status-4 @endif">
                                    <div style="float: right;">
                                        <button class="btn btn-sm btn-outline-warning" data-toggle="modal"
                                                data-target="#room-{{$room->id}}"><i
                                                class="fa fa-info"></i></button>
                                        <a href="{{route('admin.type-rooms.rooms.edit',['id' => $room->typeRoom, 'idRoom' => $room->id])}}" class="btn btn-sm btn-outline-primary"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="#" class="btn btn-sm btn-outline-danger"><i
                                                class="fa fa-trash"></i></a>
                                    </div>
                                    <h4>Room {{$room->name}}</h4>
                                </div>
                            </div>
                        </div>

                        {{--Modal--}}
                        <div class="modal fade" id="room-{{$room->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Room {{$room->name}}</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <p>Làm sau khi choose room</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-outline-success" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
