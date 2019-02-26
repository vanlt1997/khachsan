@extends('layouts.admin')
@section('title','Type Room')
@section('css')
    <style>
        .panel-info .panel-heading{
            margin: 0;
        }

        .icon a{
            margin-right: 20px;
        }
    </style>
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
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
                    <div class="panel-heading row"">
                        <div class="col-md-6">
                            <h1 class="panel-title">Information TypeRoom</h1>
                        </div>
                       <div class="col-md-6 text-right icon">
                           <a href="{{route('admin.type-rooms.create')}}">
                               <i class="fa fa-plus-circle"></i>
                           </a>
                           <a href="{{route('admin.type-rooms.edit', $typeRoom->id)}}">
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
                                    <tr  class="table-info">
                                        <th>People</th>
                                        <td>{{$typeRoom->people}}</td>
                                    </tr>
                                    <tr>
                                        <th>Bed</th>
                                        <td>{{$typeRoom->bed}}</td>
                                    </tr>
                                    <tr  class="table-info">
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
                                    <tr  class="table-info">
                                        <th>View</th>
                                        <td>{{$typeRoom->view}}</td>
                                    </tr>
                                    <tr>
                                        <th>Price</th>
                                        <td>{{$typeRoom->price}}</td>
                                    </tr>
                                    <tr  class="table-info">
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
                    <div class="panel-heading">
                        <h1 class="panel-title">Information Room</h1>
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
                                        <h2>{{$room->name}}</h2>
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
                    <div class="panel-heading">
                        <h1 class="panel-title">Images</h1>
                    </div>
                    <div class="panel-body">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
