@extends('layouts.admin')
@section('title',"Type Rooms" )
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">{{isset($typeRoom) ? 'Edit Room '.$typeRoom['name'] : 'Add Room Type'}}</h3>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <form method="post" role="form" class="form-horizontal col-md-12">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="row col-md-12">
                                <div class="col-md-4 text-right">
                                    <label for="name">Name <span>&hercon;</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="name" class="form-control"
                                           placeholder="Name" value="{{$typeRoom->name ?? null}}">
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
                                    <label for="people">People/Room <span>&hercon;</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="people" class="form-control"
                                           placeholder="0" value="{{$typeRoom->people ?? null}}">
                                    <div class="error-content">
                                        @if($errors->has('people'))
                                            <p class="text-danger"><i
                                                    class="fa fa-exclamation-circle"></i> {{$errors->first('people')}}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row col-md-12">
                                <div class="col-md-4 text-right">
                                    <label for="bed">Number Bed <span>&hercon;</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="bed" class="form-control"
                                           placeholder="0" value="{{$typeRoom->bed ?? null}}">
                                    <div class="error-content">
                                        @if($errors->has('bed'))
                                            <p class="text-danger"><i
                                                    class="fa fa-exclamation-circle"></i> {{$errors->first('bed')}}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row col-md-12">
                                <div class="col-md-4 text-right">
                                    <label for="extra-bed">Number Extra_bed</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="extra_bed" class="form-control"
                                           placeholder="0" value="{{$typeRoom->extra_bed ?? null}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" {{isset($typeRoom) ? '': 'hidden'}}>
                            <div class="row col-md-12">
                                <div class="col-md-4 text-right">
                                    <label for="number_room">Number Room <span>&hercon;</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="number_room" class="form-control"
                                           placeholder="0" value="{{$typeRoom->number_room ?? null}}" disabled>
                                    <div class="error-content">
                                        @if($errors->has('number_room'))
                                            <p class="text-danger"><i
                                                    class="fa fa-exclamation-circle"></i> {{$errors->first('number_room')}}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row col-md-12">
                                <div class="col-md-4 text-right">
                                    <label for="acreage">Acreage <span>&hercon;</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="acreage" class="form-control"
                                           placeholder="0" value="{{$typeRoom->acreage ?? null}}">
                                    <div class="error-content">
                                        @if($errors->has('acreage'))
                                            <p class="text-danger"><i
                                                    class="fa fa-exclamation-circle"></i> {{$errors->first('acreage')}}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row col-md-12">
                                <div class="col-md-4 text-right">
                                    <label for="price">Price/Day <span>&hercon;</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="price" class="form-control"
                                           placeholder="0" value="{{$typeRoom->price ?? null}}">
                                    <div class="error-content">
                                        @if($errors->has('price'))
                                            <p class="text-danger"><i
                                                    class="fa fa-exclamation-circle"></i> {{$errors->first('price')}}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row col-md-12">
                                <div class="col-md-4 text-right">
                                    <label for="sale">Sale</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="sale" class="form-control" placeholder="0"
                                           value="{{$typeRoom->sale ?? null}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row col-md-12">
                                <div class="col-md-4 text-right">
                                    <label for="view">View</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="view" class="form-control"
                                           placeholder="View" value="{{$typeRoom->view ?? null}}">
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
                                              placeholder="Mô Tả">
                                        {!! $typeRoom->description ?? null !!}
                                    </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row col-md-12">
                                <div class="col-md-4 text-right"></div>
                                <div class="col-md-8">
                                    <a href="{{route('admin.type-rooms.index')}}"
                                       class="btn btn-sm btn-outline-success">Back</a>
                                    <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="row col-md-12">
                                <div class="col-md-3 text-right">
                                    <label for="devices" class="col-form-label">Devices</label>
                                </div>
                                <div class="col-md-9 row">
                                    @foreach($devices as $device)
                                        <div class="col-md-4" style="padding-top: 10px;">
                                            <label for="device{{$device->id}}">
                                                <input type="checkbox" name="devices[]" id="device{{$device->id}}" value="{{$device->id}}"
                                                       @if(isset($deviceTypeRoom) && in_array($device->id, $deviceTypeRoom))
                                                           checked
                                                       @endif
                                                > {{$device->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row col-md-12">
                                <div class="col-md-3 text-right">
                                    <label for="Image" class="col-form-label">Images</label>
                                </div>
                                <div class="col-md-9">
                                    <button type="button" class="btn btn-sm btn-outline-warning" data-toggle="modal"
                                            data-target="#type-rooms" onclick="listModal()">Choose Images
                                    </button>
                                    <div class="row col-md-12" id="images-session">
                                        @if(isset($typeRoom))
                                            @foreach($typeRoom['images'] as $image)
                                                <div class='col-md-3 img-show pull-left img-start'
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
                        <div class="col-md-12">
                            @if($errors->has('Image'))
                                <p class="text-danger"><i
                                        class="fa fa-exclamation-circle"></i> {{$errors->first('Image')}}</p>
                            @endif
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
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
@endsection
@push('scripts')
    <script src="{{asset('js/admin/main.js')}}"></script>
@endpush

