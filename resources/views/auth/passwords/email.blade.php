<?php
$slidebars = \App\Models\SlideBar::all();
?>
@extends('layouts.app')
@section('title','Login')
<style>
    .reservation {
        margin-top: -613px !important;
        margin-bottom: 200px !important;
    }
</style>
@section('slidebar')
    <section class="home-slider owl-carousel">
        @foreach($slidebars as $slidebar)
            <div class="slider-item" style="background-image: url({{asset("images/slidebars/$slidebar->url")}});">
                <div class="overlay"></div>
            </div>
        @endforeach
    </section>
    <!-- END slider -->
    <div class="container">
        <div class="row justify-content-center ftco-animate">
            <div class="col-lg-6 col-md-6 reservation pt-5 pb-5">
                <div class="text-danger text-center mb-5"><h3>{{ __('Email For Reset Password') }}</h3></div>
                <div class="block-17">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

