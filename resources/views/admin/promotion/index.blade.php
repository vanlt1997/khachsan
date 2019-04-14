@extends('layouts.admin')
@section('title','Promotions')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/alert.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/promotion.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Promotions</h3>
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
        <table class="table table-striped table-bordered" id="promotions-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Price</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Code</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="container" style="clear: both">
        <a href="{{route('admin.promotions.create')}}" class="btn btn-sm btn-outline-info"><i
                class="fa fa-plus-circle"></i> Add</a>
        <a id="btnSendMail" href="javascript:;" class="btn btn-sm btn-outline-success"><i
                    class="fa fa-send-o"></i> Send Mail</a>
        <p class="text-danger">
            Choose row for send mail promotions.
        </p>
    </div>
@endsection
@push('scripts')
    <script>

        $(document).ready(function () {
            var selected = [];
            $('#promotions-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{route('admin.promotions.getList')}}',
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'sale', name: 'sale'},
                    {data: 'startDate', name: 'startDate'},
                    {data: 'endDate', name: 'endDate'},
                    {data: 'code', name: 'code'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                rowCallback: function (row, data) {
                    if ($.inArray(data.id, selected) !== -1) {
                        $(row).addClass('selected');
                    }
                }
            });
            $('#promotions-table tbody').on('click', 'tr', function () {
                var id = $(this).find(">:first-child").text();
                var index = $.inArray(id, selected);
                if (index === -1) {
                    selected.push(id);
                } else {
                    selected.splice(index, 1);
                }
                $(this).toggleClass('selected');
            });

            $('#btnSendMail').on('click', function () {
                var selects = [];
                $('#promotions-table>tbody>tr').each(function (e) {
                    if($(this).hasClass('selected')){
                        var id = parseInt($(this).find(">:first-child").text());
                        selects.push(id);
                    }
                });
                if (selects.length <= 0){
                    alert('Choose email before send mail !!!');
                } else {
                    $.ajax({
                        url: '{{route('admin.promotions.sendMail')}}',
                        type: 'POST',
                        contentType: 'application/json;charset=utf8',
                        data: JSON.stringify({'Ids' : selects}),
                        success: function (count) {
                            alert('Send mail success for '+ count +' user .');
                            $('#promotions-table>tbody>tr').removeClass('selected');
                        }
                    });
                }
            });
        });

    </script>
@endpush
