@extends('layouts.client')
@section('title','Information User')
@section('slidebar')
    <section class="home-slider owl-carousel">
        @if($slidebars->count() > 0)
            @foreach($slidebars as $slidebar)
                <div class="slider-item" style="background-image: url({{asset("images/slidebars/$slidebar->url")}});">
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="row slider-text align-items-end">
                            <div class="col-md-10 col-sm-12 ftco-animate mb-4">
                                <p class="breadcrumbs"><span class="mr-2"><a
                                                href="{{route('client.index')}}">Home</a></span>
                                    <span>Information User</span></p>
                                <h1 class="mb-3">Update Password</h1>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </section>
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
                    <h3 class="text-danger">Update Password</h3>
                </div>
            </div>
            <div class="row block-9">
                <div class="col-md-12">
                    <form method="post">
                        @csrf
                        <div class="form-group row col-md-12">
                            <div class="col-md-2">
                                <label for="password_old">Password Old <span class="text-danger">&hercon;</span></label>
                            </div>
                            <div class="col-md-10">
                                <input type="password" name="password_old" class="form-control" placeholder="Password Old" value="{{old('password_old')}}">
                                <div class="error-content">
                                    @if($errors->has('password_old'))
                                        <p class="text-danger"><i
                                                    class="fa fa-exclamation-circle"></i> {{$errors->first('password_old')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row col-md-12">
                            <div class="col-md-2">
                                <label for="password">Password <span class="text-danger">&hercon;</span></label>
                            </div>
                            <div class="col-md-10">
                                <input type="password" name="password" class="form-control" placeholder="Password" value="{{old('password')}}">
                                <div class="error-content">
                                    @if($errors->has('password'))
                                        <p class="text-danger"><i
                                                    class="fa fa-exclamation-circle"></i> {{$errors->first('password')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row col-md-12">
                            <div class="col-md-2">
                                <label for="password_confirmation">Confirm Password <span class="text-danger">&hercon;</span></label>
                            </div>
                            <div class="col-md-10">
                                <input type="password" name="password_confirmation" class="form-control"
                                       placeholder="Confirm Password" value="{{old('password_confirmation')}}">
                            </div>
                        </div>
                        <div class="form-group row col-md-12">
                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <a href="{{route('client.information')}}" class="btn btn-outline-info btn-sm col-md-offset-2 mr-3">Back</a>
                                <button type="submit" class="btn btn-outline-primary btn-sm col-md-offset-2">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).on("ready", function () {
            $('html, body').animate({
                scrollTop: $("#contactForm").offset().top
            }, 1000);
        });
    </script>
@endpush
