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
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{Session::get('message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{Session::get('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
            <tbody>

            </tbody>
        </table>
    </div>
    <div class="container" style="clear: both">
        <a href="{{route('admin.index')}}" class="btn btn-outline-success btn-sm">Cancel</a>
        <a href="#" class="btn btn-outline-warning btn-sm" onclick="test()">Test</a>
        <a href="{{route('admin.type-rooms.createTypeRoom')}}" class="btn btn-sm btn-outline-info"><i
                class="fa fa-plus-circle"></i> Add</a>
    </div>
@endsection
@push('scripts')
    {{--<script>
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
    </script>--}}
    <script>
        String.prototype.replaceAll = function (arrayKeyValue) {
            var _this = this;
            arrayKeyValue.forEach(function (KeyValue) {
                _this = _this.replace(new RegExp('{' + KeyValue.key + '}', 'g'), KeyValue.value);
            });
            return _this;
        };

        function templateRow(params) {
            const {id, name, people, price, sale} = params;
            let tmp = '<tr id="row{id}"><td>{id}</td><td>{name}</td><td>{people}</td><td>{price}</td><td>{sale}</td>' +
                '<td><button class="btn btn-danger btnDelete" id="{id}">Delete</button></td>' +
                '</tr>';
            return tmp.replaceAll([
                {key: "id", value: id},
                {key: "name", value: name},
                {key: "people", value: people},
                {key: "price", value: price},
                {key: "sale", value: sale},

            ]);
        }

        $(document).on("click",".btnDelete" ,function () {
            var id = $(this).attr("id");
            var data = {"id" : id};
            $.ajax({
                url: '<?php echo route('admin.type-rooms.deleteTest', id); ?>',
                type: "POST",
                contentType: "application/json;charset=utf8",
                data: JSON.stringify(data),
                success: function (resp) {
                    $("#row"+id).remove();
                },
                error: function (e) {

                }
            });
        });

        function test() {
            $.ajax({
                url: '<?php echo route('admin.type-rooms.test'); ?>',
                type: "GET",
                contentType: "application/json;charset=utf8",
                success: function (resp) {
                    var table = $("#typeroom-table > tbody");
                    table.empty();
                    $.each(resp, function (i, item) {
                        let data = {id: item.id, name: item.name, people: item.people, price: item.price, sale: item.sale};
                        let tem = templateRow(data);
                        table.append(tem);
                    })
                },
                error: function (e) {

                }
            });
        }

    </script>
@endpush

