@extends('layouts.admin')
@section('title','Orders Handled')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/alert.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/order.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Orders Handled</h3>
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
        <table class="table table-striped table-bordered" id="orders-handled-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Payment Method</th>
                <th>Type Room Number</th>
                <th>Total</th>
                <th>Promotion</th>
                <th>Payment Total</th>
                <th>Order Date</th>
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
            $('#orders-handled-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{route('admin.orders.list-handled')}}',
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
                        data: 'payment_method',
                        name: 'payment_method',
                    },
                    {data: 'quantity', name: 'quantity'},
                    {data: 'total', name: 'total'},
                    {data: 'promotion', name: 'promotion'},
                    {data: 'payment_total', name: 'payment_total'},
                    {data: 'date', name: 'date'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush
