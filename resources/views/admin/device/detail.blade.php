@extends('layouts.admin')
@section('title','Type Room')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Detail {{$device->name}}</h3>
        </div>
    </div>

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading row" style="margin: 0">
                        <div class="col-md-6">
                            <h1 class="panel-title">Information Device</h1>
                        </div>
                        <div class="col-md-6 text-right icon">
                            <a href="{{route('admin.devices.create')}}" class="btn btn-sm btn-outline-info">
                                <i class="fa fa-plus-circle"></i>
                            </a>
                            <a href="{{route('admin.devices.edit', $device->id)}}"
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
                                    <td>{{$device->name}}</td>
                                </tr>
                                <tr class="table-info">
                                    <th>Number</th>
                                    <td>{{$device->quantity}}</td>
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
                            <h1 class="panel-title">TypeRoom Are Using</h1>
                        </div>
                        <div class="col-md-6 text-right icon">
                            <a href="#"
                               class="btn btn-sm btn-outline-info">
                                <i class="fa fa-plus-circle"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
