@extends('layouts.admin')
@section('title','Users')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">{{isset($user) ? 'Edit '.$user->name : 'Create User'}}</h3>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <form method="post" role="form"
                  class="form-horizontal col-md-8" style="margin: 0 auto">
                @csrf
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-4 text-right">
                            <label for="name">Name <span>&hercon;</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="name" class="form-control"
                                   placeholder="Name" value="{{$user->name?? null}}">
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
                        <div class="col-md-4 text-right">
                            <label for="email">Email <span>&hercon;</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="email" name="email" class="form-control"
                                   placeholder="Name" value="{{$user->email?? null}}">
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
                        <div class="col-md-4 text-right">
                            <label for="sex">Sex</label>
                        </div>
                        <div class="col-md-8">
                            <select name="sex" class="form-control" onchange="changeSelect()" id="sex">
                                <option value="Male" @if(isset($user) && $user->sex === 'Male') selected @endif>Male</option>
                                <option value="Female" @if(isset($user) && $user->sex === 'Female') selected @endif>Female</option>
                                <option value="Other" @if(isset($user) && $user->sex === 'Other') selected @endif>Other</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-4 text-right">
                            <label for="phone">Phone</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="phone" class="form-control" value="{{$user->phone ?? null}}" id="phone" >
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
                        <div class="col-md-4 text-right">
                            <label for="address">Address</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="address" class="form-control"  cols="30" rows="5">
                                {!! $user->address ?? null !!}
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-4 text-right"></div>
                        <div class="col-md-8">
                            <a href="{{route('admin.users.index')}}" class="btn btn-sm btn-outline-success mr-3">Back</a>
                            <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('js/admin/service.js')}}"></script>
@endpush


