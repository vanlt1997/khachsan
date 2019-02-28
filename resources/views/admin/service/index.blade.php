@extends('layouts.admin')
@section('title','Services')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/alert.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Services</h3>
        </div>
    </div>

@endsection
@section('content')
    <div class="container">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show alert-custom-success" role="alert">
                <i class="fa fa-check"></i>
                {{Session::get('message')}}
            </div>
        @endif
        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show alert-custom-error" role="alert">
                <i class="fa fa-warning"></i>
                {{Session::get('error')}}
            </div>
        @endif
        <table class="table table-striped table-bordered" id="service-table">
            <thead>
            <tr>
                <th>ID</th>
                <th style="width: 100px">Name</th>
                <th style="width: 50px">Price</th>
                <th style="width: 50px">Sale(%)</th>
                <th style="width: 50px">Number</th>
                <th>Description</th>
                <th style="width: 100px">Action</th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="container" style="clear: both">
        <a href="{{route('admin.services.create')}}" class="btn btn-sm btn-outline-info"><i
                class="fa fa-plus-circle"></i> Add</a>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            $('#service-table').DataTable({
                processing: true,
                serverSide: true,

                ajax: {
                    url: '{{route('admin.services.getList')}}',
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'price', name: 'price'},
                    {data: 'sale', name: 'sale'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'description', name: 'description'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush
