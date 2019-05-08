@extends('layouts.admin')
@section('title','Services')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/service.css')}}">
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
                        <div class="col-md-4 text-right">
                            <label for="Image" class="col-form-label">Images</label>
                        </div>
                        <div class="col-md-8">
                            <button type="button" class="btn btn-sm btn-outline-warning mb-5" data-toggle="modal"
                                    data-target="#type-rooms" onclick="listModal()">Choose Images
                            </button>
                            <div class="row col-md-12" id="images-session">
                                @if(isset($service))
                                    @foreach($service->images as $image)
                                        <div class='col-md-4 img-show pull-left img-start'
                                             data-content="{{$image->url}}">
                                            <div class='reject-img' onclick="rejectImage('{{$image->url}}')">
                                                <span class='button-reject-img'>&times;</span>
                                            </div>
                                            <img src="{{asset('images/admin/library-images')}}/{{$image->url}}"
                                                 alt='img' class='img-thumbnail' style='width: 120px; height: 120px;'>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="row col-md-12" hidden>
                                <input type="text" class="form-control" name="images" id="images">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-4 text-right"></div>
                        <div class="col-md-8">
                            <a href="{{route('admin.services.index')}}" class="btn btn-sm btn-outline-success mr-3">Back</a>
                            <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            {{--Modal--}}
            <div class="modal fade" id="type-rooms" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                 aria-hidden="true" onclick="chooseDone()">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Choose Images</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    @foreach($images as $image)
                                        <div class="col-md-3 img-show img-modal" id="{{$image->url}}">
                                            <img src="{{asset('images/admin/library-images')}}/{{$image->url}}"
                                                 alt="{{$image->url}}"
                                                 id="{{$image->id}}"
                                                 class="img-thumbnail" style="width: 120px; height: 120px"
                                                 onclick="chooseImages('{{$image->url}}')"/>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-outline-success" data-dismiss="modal">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('js/admin/service.js')}}"></script>
    <script src="{{asset('js/admin/main.js')}}"></script>
@endpush


