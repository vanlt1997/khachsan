@extends('layouts.admin')
@section('title','Orders')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/alert.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/order.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Orders</h3>
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
        <table class="table table-striped table-bordered" id="orders-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Type Room</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Number</th>
                <th>Price</th>
                <th>Sale (%)</th>
                <th>Total</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="container" style="clear: both">
        <a href="{{route('admin.orders.create')}}" class="btn btn-sm btn-outline-info"><i
                    class="fa fa-plus-circle"></i> Add</a>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            $('#orders-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{route('admin.orders.getList')}}',
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {
                        data: null,
                        name: 'user_name',
                        render: function (data) {
                            return data.user_name;
                        }
                    },
                    {
                        data: null,
                        name: 'type_room',
                        render: function (data) {
                            return data.type_room;
                        }
                    },
                    {
                        data: null,
                        name: 'payment_method',
                        render: function (data) {
                            return data.payment_method;
                        }
                    },
                    {
                        data: null,
                        name: 'status',
                        render: function (data) {
                            return data.status;
                        }
                    },
                    {data: 'quantity', name: 'quantity'},
                    {data: 'price', name: 'price'},
                    {data: 'sale', name: 'sale'},
                    {data: 'total', name: 'total'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'end_date', name: 'end_date'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush
