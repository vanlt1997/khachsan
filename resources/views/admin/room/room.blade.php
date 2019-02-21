@extends('layouts.admin')
@section('title','Room')
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Room</h3>
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
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="container" style="clear: both">
        <a href="{{route('admin.type-rooms.rooms.create', $idTypeRoom)}}" class="btn btn-sm btn-outline-info"><i
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
                    url: '{!!route('admin.type-rooms.rooms.getListRoomByTypeRoom', $idTypeRoom)!!}',
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
