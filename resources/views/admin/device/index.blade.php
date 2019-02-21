@extends('layouts.admin')
@section('title','Devices')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
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
        <table class="table table-striped table-bordered" id="room-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="container" style="clear: both">
        <a href="#" class="btn btn-sm btn-outline-info"><i
                class="fa fa-plus-circle"></i> Thêm mới</a>
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
                ]
            });
        });
    </script>
@endpush
