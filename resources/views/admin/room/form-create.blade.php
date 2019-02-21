@extends('layouts.admin')
@section('title','Create Type Room')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Create Room</h3>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <form method="post" action="{{ route('admin.type-rooms.rooms.action-create', $idTypeRoom) }}" role="form"
                  class="form-horizontal col-md-offset-6">
                @csrf
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-4 text-right">
                            <label for="name">Name <span>&hercon;</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="name" class="form-control"
                                   placeholder="Name">
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
                            <label for="name">Status</label>
                        </div>
                        <div class="col-md-8">
                            <select name="status" class="form-control">
                                @foreach($status as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-4 text-right">
                            <label for="description">Description</label>
                        </div>
                        <div class="col-md-8">
                                    <textarea name="description" class="form-control" id="editor" cols="30" rows="10"
                                              placeholder="Mô Tả"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-4 text-right"></div>
                        <div class="col-md-8">
                            <a href="{{route('admin.type-rooms.rooms.getRoomByTypeRoom', $idTypeRoom)}}"
                               class="btn btn-outline-danger">Trở
                                về</a>
                            <button type="submit" class="btn btn-outline-primary">Lưu</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

