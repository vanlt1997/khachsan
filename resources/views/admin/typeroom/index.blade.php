@extends('layouts.admin')
@section('title','Loại Phòng')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/alert.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Room Types</h3>
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
        <table class="table table-striped table-bordered" id="typeroom-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>People Number</th>
                <th>Price</th>
                <th>Sale</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="container" style="clear: both">
        <a href="{{route('admin.index')}}" class="btn btn-outline-success btn-sm">Cancel</a>
        <a href="{{route('admin.type-rooms.createTypeRoom')}}" class="btn btn-sm btn-outline-info"><i
                class="fa fa-plus-circle"></i> Add</a>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            $('#typeroom-table').DataTable({
                processing: true,
                serverSide: true,

                ajax: {
                    url: '{{route('admin.type-rooms.getListTypeRoom')}}',
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'people', name: 'people'},
                    {data: 'price', name: 'price'},
                    {data: 'sale', name: 'sale'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush
