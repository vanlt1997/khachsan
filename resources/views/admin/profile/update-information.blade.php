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
    <section class="ftco-section contact-section" id="contactForm">
        <div class="container bg-light">
            @if(Session::has('message'))
                <div class="row d-flex contact-info alert alert-success alert-dismissible fade show alert-custom-success"
                     role="alert">
                    <i class="fa fa-check"></i>
                    {{Session::get('message')}}
                </div>
            @endif
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-6 mb-4">
                    <h3 class="text-danger">Update Information</h3>
                </div>
            </div>
            <div class="row block-9">
                <div class="col-md-12">
                    <form method="post" id="formInformation">
                        @csrf
                        <div class="form-group row col-md-12">
                            <div class="col-md-2">
                                <label for="name">Name</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="name" class="form-control" placeholder="Name"
                                       value="{{$user->name}}">
                            </div>
                        </div>
                        <div class="form-group row col-md-12">
                            <div class="col-md-2">
                                <label for="name">Email</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="email" class="form-control" placeholder="Email"
                                       value="{{$user->email}}" readonly>
                            </div>
                            <div class="error-content">
                                @if($errors->has('email'))
                                    <p class="text-danger"><i
                                                class="fa fa-exclamation-circle"></i> {{$errors->first('email')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row col-md-12">
                            <div class="col-md-2">
                                <label for="phone">Phone</label>
                            </div>
                            <div class="col-md-10">
                                <input type="tel" name="phone" class="form-control" placeholder="Phone"
                                       value="{{$user->phone}}">
                            </div>
                            <div class="error-content">
                                @if($errors->has('phone'))
                                    <p class="text-danger"><i
                                                class="fa fa-exclamation-circle"></i> {{$errors->first('phone')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row col-md-12">
                            <div class="col-md-2">
                                <label for="address">Address</label>
                            </div>
                            <div class="col-md-10">
                                <textarea cols="30" rows="7" name="address" class="form-control"
                                          placeholder="Address">{{$user->address}}</textarea>
                            </div>
                            <div class="error-content">
                                @if($errors->has('address'))
                                    <p class="text-danger"><i
                                                class="fa fa-exclamation-circle"></i> {{$errors->first('address')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row col-md-12">
                            <div class="col-md-2">
                                <label for="sex">Sex</label>
                            </div>
                            <div class="col-md-10">
                                <select name="sex" class="form-control">
                                    <option value="">--- Select option ---</option>
                                    <option value="Male" @if($user->sex === 'Male') selected @endif>Male</option>
                                    <option value="Female" @if($user->sex === 'Female') selected @endif>Female</option>
                                    <option value="Other" @if($user->sex === 'Other') selected @endif>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row col-md-12">
                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <a href="{{route('admin.info')}}"  class="btn btn-outline-info btn-sm  mr-3">Back</a>
                                <button type="submit" class="btn btn-outline-primary btn-sm col-md-offset-2">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
