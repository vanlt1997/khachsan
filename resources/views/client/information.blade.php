@extends('layouts.client')
@section('title','Information User')
@section('slidebar')
    <section class="home-slider owl-carousel">
        @if($slidebars->count() > 0)
            @foreach($slidebars as $slidebar)
                <div class="slider-item" style="background-image: url('images/slidebars/{{$slidebar->url}}');">
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="row slider-text align-items-end">
                            <div class="col-md-10 col-sm-12 ftco-animate mb-4">
                                <p class="breadcrumbs"><span class="mr-2"><a href="{{route('client.index')}}">Home</a></span> <span>Information User</span></p>
                                <h1 class="mb-3">Information User</h1>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </section>
@endsection
<style>
    .contact-info>div:hover{
        cursor: pointer;
    }
    .hover{
        color: red;
        border-bottom: 2px dotted #0b93d5;
    }
    #formPassword label>span{
        color: red;
    }
</style>
@section('content')
    <section class="ftco-section contact-section" id="contactForm">
        <div class="container bg-light">
            @if(Session::has('message'))
                <div class="row d-flex contact-info alert alert-success alert-dismissible fade show alert-custom-success" role="alert">
                    <i class="fa fa-check"></i>
                    {{Session::get('message')}}
                </div>
            @endif
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-6 mb-4">
                    <h3 class="hover" onclick="showForm('information')" id="titleInformation">Update Information</h3>
                </div>
                <div class="col-md-6 mb-4">
                    <h3 onclick="showForm('password')" id="titlePassword">Update Password</h3>
                </div>
            </div>
            <div class="row block-9">
                <div class="col-md-12" >
                    <form method="post" id="formInformation" action="{{route('client.update-information')}}">
                        @csrf
                        <div class="form-group row col-md-12">
                            <div class="col-md-2">
                                <label for="name">Name</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{$user->name}}">
                            </div>
                        </div>
                        <div class="form-group row col-md-12">
                            <div class="col-md-2">
                                <label for="name">Email</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" name="email" class="form-control" placeholder="Email" value="{{$user->email}}" readonly >
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
                                <input type="tel" name="phone" class="form-control" placeholder="Phone" value="{{$user->phone}}">
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
                                <textarea cols="30" rows="7" name="address" class="form-control" placeholder="Address">{{$user->address}}</textarea>
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
                                    <option value="Male" @if($user->sex === 'Male') selected @endif>Male</option>
                                    <option value="Female" @if($user->sex === 'Female') selected @endif>Female</option>
                                    <option value="Other" @if($user->sex === 'Other') selected @endif>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row col-md-12">
                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-primary btn-sm col-md-offset-2">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
                <div class="row block-9">
                    <div class="col-md-12" >
                        <form method="post" id="formPassword" hidden action="{{route('client.update-password')}}">
                            @csrf
                            <div class="form-group row col-md-12">
                                <div class="col-md-2">
                                    <label for="password_old">Password Old <span>&hercon;</span></label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="password_old" class="form-control" placeholder="Password Old">
                                    @if ($errors->has('password_old'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_old') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row col-md-12">
                                <div class="col-md-2">
                                    <label for="password">Password <span>&hercon;</span></label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="password" class="form-control" placeholder="Password">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row col-md-12">
                                <div class="col-md-2">
                                    <label for="password_confirmation">Confirm Password <span>&hercon;</span></label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="form-group row col-md-12">
                                <div class="col-md-2"></div>
                                <div class="col-md-10">
                                    <button type="submit" class="btn btn-primary btn-sm col-md-offset-2">Save</button>
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
    $(document).on("ready",function () {
        $('html, body').animate({
            scrollTop: $("#contactForm").offset().top
        }, 1000);
    });
    function showForm(type) {
        if (type === 'information') {
            $('#formInformation').removeAttr('hidden');
            $('#formPassword').prop('hidden', 'hidden');
            $('#titlePassword').removeClass('hover');
            $('#titleInformation').addClass('hover');

        } else{
            $('#formPassword').removeAttr('hidden');
            $('#formInformation').prop('hidden', 'hidden');
            $('#titleInformation').removeClass('hover');
            $('#titlePassword').addClass('hover');
        }
    }
</script>
@endpush
