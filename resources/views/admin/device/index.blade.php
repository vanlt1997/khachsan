@extends('layouts.admin')
@section('title','Devices')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/alert.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Devies</h3>
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
        <table class="table table-striped table-bordered" id="room-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="container" style="clear: both">
        <a href="{{route('admin.devices.create')}}" class="btn btn-sm btn-outline-info"><i
                class="fa fa-plus-circle"></i> Add</a>
        <a href="{{route('admin.devices.export-pdf')}}" class="btn btn-sm btn-outline-info"><i class="fa fa-file-pdf-o"></i> Export PDF</a>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            $('#room-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{route('admin.devices.get-list')}}',
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush
