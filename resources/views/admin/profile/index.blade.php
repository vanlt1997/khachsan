@extends('layouts.admin')
@section('title','Profile Admin')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/alert.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/contact.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Profile Admin</h3>
        </div>
    </div>

@endsection
@section('content')
    <div class="container">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show alert-custom-success" role="alert">
                <i class="fa fa-check"></i>
                {{Session::get('message')}}
            </div>
        @endif
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-6 mb-4">
                    <h3 class="hover">Information Admin</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    Name
                </div>
                <div class="col-md-10">
                    {{$user->name}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    Email
                </div>
                <div class="col-md-10">
                    {{$user->email}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    Phone
                </div>
                <div class="col-md-10">
                    {{$user->phone}}
                </div>
            </div>
            @if($user->sex)
                <div class="row">
                    <div class="col-md-2">
                        Sex
                    </div>
                    <div class="col-md-10">
                        {{$user->sex}}
                    </div>
                </div>
            @endif
            @if($user->address)
                <div class="row">
                    <div class="col-md-2">
                        Address
                    </div>
                    <div class="col-md-10">
                        {{$user->address}}
                    </div>
                </div>
            @endif
            <div class="row mt-5">
                <a href="{{route('admin.edit.info')}}" class="btn btn-sm btn-outline-primary mr-3">Edit information</a>
                <a href="{{route('admin.edit.password')}}" class="btn btn-sm btn-outline-info">Edit Password</a>
            </div>

    </div>

@endsection
