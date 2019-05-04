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
                                <p class="breadcrumbs"><span class="mr-2"><a
                                                href="{{route('client.index')}}">Home</a></span>
                                    <span>Information User</span></p>
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
    .contact-info > div:hover {
        cursor: pointer;
    }

    .hover {
        color: red;
        border-bottom: 2px dotted #0b93d5;
    }

    #formPassword label > span {
        color: red;
    }
</style>
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
                    <h3 class="hover">Information User</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    Name
                </div>
                <div class="col-md-10">
                    {{$user->name}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    Email
                </div>
                <div class="col-md-10">
                    {{$user->email}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    Phone
                </div>
                <div class="col-md-10">
                    {{$user->phone}}
                </div>
            </div>
            @if($user->sex)
                <div class="row">
                    <div class="col-md-2">
                        Sex
                    </div>
                    <div class="col-md-10">
                        {{$user->sex}}
                    </div>
                </div>
            @endif
            @if($user->address)
                <div class="row">
                    <div class="col-md-2">
                        Address
                    </div>
                    <div class="col-md-10">
                        {{$user->address}}
                    </div>
                </div>
            @endif
            <div class="row mt-5">
                <a href="{{route('client.update-information')}}" class="btn btn-sm btn-outline-primary mr-3">Edit information</a>
                <a href="{{route('client.update-password')}}" class="btn btn-sm btn-outline-info">Edit Password</a>
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
