@extends('layouts.admin')
@section('title','Type Room')
@section('css')
    <style>
        .panel-info .panel-heading {
            margin: 0;
        }

        .icon a {
            margin-right: 10px;
        }
    </style>
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/library-images.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Detail {{$typeRoom->name}}</h3>
        </div>
    </div>

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading row">
                        <div class="col-md-6">
                            <h1 class="panel-title">Information TypeRoom</h1>
                        </div>
                        <div class="col-md-6 text-right icon">
                            <a href="{{route('admin.type-rooms.create')}}" class="btn btn-sm btn-outline-info">
                                <i class="fa fa-plus-circle"></i>
                            </a>
                            <a href="{{route('admin.type-rooms.edit', $typeRoom->id)}}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-edit right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <table class="table table-hover table-detail-typeroom">
                                <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{$typeRoom->name}}</td>
                                </tr>
                                <tr class="table-info">
                                    <th>People</th>
                                    <td>{{$typeRoom->people}}</td>
                                </tr>
                                <tr>
                                    <th>Bed</th>
                                    <td>{{$typeRoom->bed}}</td>
                                </tr>
                                <tr class="table-info">
                                    <th>Extra Bed</th>
                                    <td>{{$typeRoom->name}}</td>
                                </tr>
                                <tr>
                                    <th>Number Room</th>
                                    <td>{{$typeRoom->number_room}}</td>
                                </tr>
                                <tr class="table-info">
                                    <th>Extra Bed</th>
                                    <td>{{$typeRoom->name}}</td>
                                </tr>
                                <tr>
                                    <th>Acreage</th>
                                    <td>{{$typeRoom->acreage}}</td>
                                </tr>
                                <tr class="table-info">
                                    <th>View</th>
                                    <td>{{$typeRoom->view}}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>{{$typeRoom->price}}</td>
                                </tr>
                                <tr class="table-info">
                                    <th>Sale</th>
                                    <td>{{$typeRoom->sale}}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{!! $typeRoom->description !!}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-warning">
                    <div class="panel-heading row" style="margin: 0">
                        <div class="col-md-6">
                            <h1 class="panel-title">Information Room</h1>
                        </div>
                        <div class="col-md-6 text-right icon">
                            <a href="{{route('admin.type-rooms.rooms.create', $typeRoom->id)}}"
                               class="btn btn-sm btn-outline-info">
                                <i class="fa fa-plus-circle"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="bg-status-1"></div>
                                <p>Trống</p>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-status-2"></div>
                                <p>Đã giữ phòng</p>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-status-3"></div>
                                <p>Đang sử dụng</p>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-status-4"></div>
                                <p>Quá hạn</p>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($typeRoom->rooms as $room)
                                <div class="col-md-3">
                                    <div class="room">
                                        <div class="style-rooms @if($room->status_id === 1) bg-status-1
                                                                @elseif($room->status_id === 2) bg-status-2
                                                                @elseif($room->status_id === 3) bg-status-3
                                                                @else bg-status-4 @endif">
                                            <div style="float: right;">
                                                <button class="btn btn-sm btn-outline-warning" data-toggle="modal"
                                                        data-target="#room-{{$room->id}}"><i
                                                        class="fa fa-info"></i></button>
                                                <a href="#" class="btn btn-sm btn-outline-primary"><i
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
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading row" style="margin: 0">
                        <div class="col-md-6">
                            <h1 class="panel-title">Images</h1>
                        </div>
                        <div class="col-md-6 text-right icon">
                            <a href="{{route('admin.type-rooms.edit', $typeRoom->id)}}"
                               class="btn btn-sm btn-outline-info">
                                <i class="fa fa-plus-circle"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            @foreach($typeRoom->images as $image)
                                <div class="col-md-2 img-show">
                                    <img src="{{asset('images/admin/library-images')}}/{{$image->url}}" alt="{{$image->url}}"
                                         class="img-thumbnail"/>
                                    <form method="post" action="{{route('admin.library-images.delete', $image->id)}}">
                                        @csrf
                                        <button type="submit" class="btn btn-sm"><span>x</span></button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
