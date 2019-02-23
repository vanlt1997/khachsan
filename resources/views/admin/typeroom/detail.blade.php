@extends('layouts.admin')
@section('title','Loại Phòng')
@section('css')
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

@endsection
