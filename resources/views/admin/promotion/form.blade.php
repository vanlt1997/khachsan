@extends('layouts.admin')
@section('title','Promotion')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">{{ isset($promotion) ? 'Edit Promotion'.$promotion->name :'Add Promotion' }}</h3>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <form method="post" role="form" class="form-horizontal col-md-10" style="margin: 0 auto">
                @csrf
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-3 text-right">
                            <label for="title">Title <span>&hercon;</span></label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="title" class="form-control"
                                   placeholder="Name" value="{{ $promotion->title ?? null }}">
                            <div class="error-content">
                                @if($errors->has('title'))
                                    <p class="text-danger"><i
                                            class="fa fa-exclamation-circle"></i> {{$errors->first('title')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-3 text-right">
                            <label for="sale">Sale ($) <span>&hercon;</span></label>
                        </div>
                        <div class="col-md-9">
                            <input type="number" name="sale" id="sale" class="form-control" placeholder="Sale" value="{{$promotion->sale ?? null}}">
                            <div class="error-content">
                                @if($errors->has('sale'))
                                    <p class="text-danger"><i
                                            class="fa fa-exclamation-circle"></i> {{$errors->first('sale')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-3 text-right">
                            <label for="startDate">Start Date <span>&hercon;</span></label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="startDate" id="startDate" class="form-control" value="{{$promotion->startDate ?? null}}">
                            <div class="error-content">
                                @if($errors->has('startDate'))
                                    <p class="text-danger"><i
                                            class="fa fa-exclamation-circle"></i> {{$errors->first('startDate')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3 text-right">
                            <label for="endDate">End Date <span>&hercon;</span></label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="endDate" id="endDate" class="form-control" value="{{$promotion->endDate ?? null}}">
                            <div class="error-content">
                                @if($errors->has('endDate'))
                                    <p class="text-danger"><i
                                            class="fa fa-exclamation-circle"></i> {{$errors->first('endDate')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-3 text-right">
                            <label for="sale">Code <span>&hercon;</span></label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="code" id="code" class="form-control" placeholder="Sale" value="{{$promotion->code ?? null}}" readonly>
                            <div class="error-content">
                                @if($errors->has('code'))
                                    <p class="text-danger"><i
                                                class="fa fa-exclamation-circle"></i> {{$errors->first('code')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-sm btn-outline-success form-control" id="btnGenCode" style="height: 38px">Generate</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-3 text-right">
                            <label for="description">Description</label>
                        </div>
                        <div class="col-md-9">
                                    <textarea name="description" class="form-control" id="editor" cols="30" rows="10"
                                              placeholder="Description">
                                        {!! $promotion->description ?? null !!}
                                    </textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-3 text-right"></div>
                        <div class="col-md-8">
                            <a href="{{route('admin.promotions.index')}}"
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
    <script>
        $('#btnGenCode').on('click', function () {
            var code = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
            $('#code').val(code)
        });
    </script>
@endpush

