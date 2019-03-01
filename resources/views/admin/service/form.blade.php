@extends('layouts.admin')
@section('title','Services')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">{{isset($service) ? 'Edit '.$service->name : 'Create Service'}}</h3>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <form method="post" role="form"
                  class="form-horizontal col-md-8">
                @csrf
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-4 text-right">
                            <label for="name">Name <span>&hercon;</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="name" class="form-control"
                                   placeholder="Name" value="{{$service->name?? null}}">
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
                            <label for="name">Use</label>
                        </div>
                        <div class="col-md-8">
                            <select name="status" class="form-control" onchange="changeSelect()" id="status">
                                <option value="1" @if(isset($service) && $service->status === 1) selected @endif>General Service</option>
                                <option value="0" @if(isset($service) && $service->status === 0) selected @endif>Room Service</option>
                            </select>
                            <div class="error-content">
                                @if($errors->has('status'))
                                    <p class="text-danger"><i
                                            class="fa fa-exclamation-circle"></i> {{$errors->first('status')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div  id="div-status" hidden>
                    <div class="form-group">
                        <div class="row col-md-12">
                            <div class="col-md-4 text-right">
                                <label for="name">Price <span>&hercon;</span></label></label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" name="price" class="form-control" value="{{$service->price ?? 0}}" id="price" >
                                <div class="error-content">
                                    @if($errors->has('price'))
                                        <p class="text-danger"><i
                                                class="fa fa-exclamation-circle"></i> {{$errors->first('price')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row col-md-12">
                            <div class="col-md-4 text-right">
                                <label for="name">Sale</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" name="sale" class="form-control" value="{{$service->sale ?? 0}}" id="sale" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row col-md-12">
                            <div class="col-md-4 text-right">
                                <label for="name">Number <span>&hercon;</span></label></label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" name="quantity" class="form-control" value="{{$service->quantity ?? 0}}" id="quantity" >
                                <div class="error-content">
                                    @if($errors->has('quantity'))
                                        <p class="text-danger"><i
                                                class="fa fa-exclamation-circle"></i> {{$errors->first('quantity')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-4 text-right">
                            <label for="description">Description</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="description" class="form-control" id="editor" cols="30" rows="10">
                                {!! $service->description ?? null !!}
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-4 text-right"></div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="col-md-4">

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('js/admin/service.js')}}"></script>
@endpush


