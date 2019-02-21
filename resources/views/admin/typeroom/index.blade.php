@extends('layouts.admin')
@section('title','Loại Phòng')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Loại Phòng</h3>
        </div>
    </div>

@endsection
@section('content')
    <div class="container">
        <table class="table table-striped table-bordered" id="typeroom-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Loại Phòng</th>
                <th>Số Người</th>
                <th>Số Phòng</th>
                <th>Min Giá</th>
                <th>Giảm Giá</th>
                <th>Hoạt Động</th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="container" style="clear: both">
        <a href="{{route('admin.type-rooms.createTypeRoom')}}" class="btn btn-sm btn-outline-info"><i
                class="fa fa-plus-circle"></i> Thêm mới</a>
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
                    {data: 'number_room', name: 'number_room'},
                    {data: 'price', name: 'price'},
                    {data: 'sale', name: 'sale'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush
