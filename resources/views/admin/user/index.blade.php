@extends('layouts.admin')
@section('title','Users')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/alert.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/user.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Users</h3>
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
        <div class="row">
            <form action="{{route('admin.users.import-excel')}}" method="post" class="col-md-12 pt-5 mb-5" style="border-bottom: 2px dotted #0b93d5">
                @csrf
                <div class="form-group row col-md-12">
                    <div class="col-md-2">
                        <label for="csv_file">CSV file to import</label>
                    </div>
                    <div class="col-md-10">
                        <input type="file" name="csv_file" class="form-group">
                        @if ($errors->has('csv_file'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('csv_file') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row col-md-12">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <label>
                            <input type="checkbox" name="header" checked> File contains header row?
                        </label>
                    </div>
                </div>
                <div class="form-group row col-md-12">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-sm btn-outline-primary">Parse CSV</button>
                    </div>
                </div>
            </form>
        </div>
        <table class="table table-striped table-bordered" id="users-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Sex</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="container" style="clear: both">
        <a href="{{route('admin.users.create')}}" class="btn btn-sm btn-outline-info"><i
                    class="fa fa-plus-circle"></i> Add</a>
        <a id="btnSendMail" href="javascript:void(0);" class="btn btn-sm btn-outline-success"><i
                    class="fa fa-send-o"></i> Send Mail</a>
        <a href="{{route('admin.users.export-pdf')}}" class="btn btn-sm btn-outline-info"><i class="fa fa-file-pdf-o"></i> Export PDF</a>
        <a href="{{route('admin.users.import-excel')}}" class="btn btn-sm btn-outline-primary"><i class="fa fa-file-excel-o"></i> Import Excel</a>
        <p class="text-danger">
            Choose row send mail promotions.
        </p>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            var selected = [];
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,

                ajax: {
                    url: '{{route('admin.users.getList')}}',
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'sex', name: 'sex'},
                    {data: 'address', name: 'address'},
                    {data: 'phone', name: 'phone'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                rowCallback: function (row, data) {
                    if ($.inArray(data.id, selected) !== -1) {
                        $(row).addClass('selected');
                    }
                }
            });

            $('#users-table tbody').on('click', 'tr', function () {
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
                $('#users-table>tbody>tr').each(function (e) {
                    if($(this).hasClass('selected')){
                        var id = parseInt($(this).find(">:first-child").text());
                        selects.push(id);
                    }
                });
                if (selects.length <= 0){
                    alert('Choose email before send mail !!!');
                } else {
                    $.ajax({
                        url: '{{route('admin.users.sendMail')}}',
                        type: 'POST',
                        contentType: 'application/json;charset=utf8',
                        data: JSON.stringify({'Ids' : selects}),
                        success: function (count) {
                            alert('Send mail success for '+ count +' user .');
                            $('#users-table>tbody>tr').removeClass('selected');
                        }
                    });
                }
            });
        });
    </script>
@endpush
