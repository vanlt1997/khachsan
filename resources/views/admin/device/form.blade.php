@extends('layouts.admin')
@section('title','Device')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">{{ isset($device) ? 'Edit Device'.$device->name :'Add Device' }}</h3>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <form method="post" role="form" class="form-horizontal col-md-6" style="margin: 0 auto">
                @csrf
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-4 text-right">
                            <label for="name">Name <span>&hercon;</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="name" class="form-control"
                                   placeholder="Name" value="{{$device->name ?? null}}">
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
                            <label for="name">Number <span>&hercon;</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Number" value="{{$device->quantity ?? null}}">
                            <div class="error-content">
                                @if($errors->has('quantity'))
                                    <p class="text-danger"><i
                                            class="fa fa-exclamation-circle"></i> {{$errors->first('quantity')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-4 text-right"></div>
                        <div class="col-md-8">
                            <a href="{{route('admin.devices.index')}}"
                               class="btn btn-sm btn-outline-danger">Back</a>
                            <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('js/admin/main.js')}}"></script>
@endpush

