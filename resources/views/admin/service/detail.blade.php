@extends('layouts.admin')
@section('title','Services')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/alert.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Detail {{$service->name}}</h3>
        </div>
    </div>

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h1 class="panel-title">Information</h1>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <table class="table table-hover table-detail-typeroom">
                                <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{$service->name}}</td>
                                </tr>
                                <tr class="table-info">
                                    <th>Description</th>
                                    <td>{!! $service->description !!}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

