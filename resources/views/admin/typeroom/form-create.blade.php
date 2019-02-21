@extends('layouts.admin')
@section('title','Create Type Room')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Thêm Mới Loại Phòng</h3>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <form method="post" role="form" class="form-horizontal col-md-12">
                @csrf
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <div class="row col-md-12">
                                <div class="col-md-4 text-right">
                                    <label for="name">Tên Loại Phòng <span>&hercon;</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="name" class="form-control"
                                           placeholder="Tên Loại Phòng">
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
                                    <label for="people">Số Người/Phòng <span>&hercon;</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="people" class="form-control"
                                           placeholder="0">
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
                                    <label for="bed">Số Giường Chính <span>&hercon;</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="bed" class="form-control"
                                           placeholder="0">
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
                                    <label for="extra-bed">Số Giường Phụ</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="extra-bed" class="form-control"
                                           placeholder="0">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row col-md-12">
                                <div class="col-md-4 text-right">
                                    <label for="number_room">Số Phòng <span>&hercon;</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="number_room" class="form-control"
                                           placeholder="0">
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
                                    <label for="acreage">Diện Tích <span>&hercon;</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="acreage" class="form-control"
                                           placeholder="0">
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
                                    <label for="price">Giá/Ngày <span>&hercon;</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="price" class="form-control"
                                           placeholder="0">
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
                                    <label for="sale">Giảm Giá</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="sale" class="form-control" placeholder="0">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row col-md-12">
                                <div class="col-md-4 text-right">
                                    <label for="view">Hướng Nhìn</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="view" class="form-control"
                                           placeholder="Hướng Nhìn">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row col-md-12">
                                <div class="col-md-4 text-right">
                                    <label for="description">Mô Tả</label>
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
                                    <a href="{{route('admin.type-rooms.index')}}" class="btn btn-outline-danger">Trở về</a>
                                    <button type="submit" class="btn btn-outline-primary">Lưu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="Image" class="col-form-label">Ảnh</label>
                            </div>
                            <div class="col-md-12">
                                {{--<div class="upload-image">
                                    <p>
                                        <label for="files">Ảnh ....</label>
                                    </p>
                                </div>
                                <input type="file" id="files" name="files[]" multiple accept="image/*"/>--}}
                                <select name="images[]" multiple class="form-control">
                                    @foreach($images as $img)
                                        <option value="{{$img->id}}" onclick="showImages(this)">{{$img->url}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-12">
                                <div class="img-upload">
                                    <output id="list"></output>
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
    <script>
        /*function handleFileSelect(evt) {
            var files = evt.target.files;
            for (var i = 0, f; f = files[i]; i++) {
                if (!f.type.match('image.*')) {
                    continue;
                }
                var reader = new FileReader();
                reader.onload = (function (theFile) {
                    return function (e) {
                        var span = document.createElement('span');
                        span.innerHTML = ['<img class="img-thumbnail" width=40% height=40% src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
                        document.getElementById('list').insertBefore(span, null);
                    };
                })(f);
                reader.readAsDataURL(f);
            }
        }
        document.getElementById('files').addEventListener('change', handleFileSelect, false);*/
        function showImages() {
            var span = document.createElement('span');
            span.innerHTML = ['<img class="img-thumbnail" width=40% height=40% src="', e.target.result,
                '" title="', escape(theFile.name), '"/>'].join('');
            document.getElementById('list').insertBefore(span, null);
        }
    </script>
@endsection

