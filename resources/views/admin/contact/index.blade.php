@extends('layouts.admin')
@section('title','Contact')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/typeroom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/alert.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/contact.css')}}">
@endsection
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Contacts</h3>
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
        <table class="table table-striped table-bordered" id="contact-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Title</th>
                <th>Content</th>
            </tr>
            </thead>
        </table>
    </div>
    <div class="container" style="clear: both">
        <a id="btnDeleteContact" href="javascript:;" class="btn btn-sm btn-outline-info"><i
                    class="fa fa-trash-o"></i> Delete</a>
        <a id="btnSendMail" href="javascript:;" class="btn btn-sm btn-outline-success"><i
                    class="fa fa-send"></i> Send Mail</a>
        <p class="text-danger">
            Choose row for delete or send mail promotions.
        </p>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            var selected = [];
            $('#contact-table').DataTable({
                processing: true,
                serverSide: true,

                ajax: {
                    url: '{{route('admin.contacts.getList')}}',
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'email', name: 'email'},
                    {data: 'title', name: 'title'},
                    {data: 'content', name: 'content'},
                ],
                rowCallback: function (row, data) {
                    if ($.inArray(data.id, selected) !== -1) {
                        $(row).addClass('selected');
                    }
                }
            });

            $('#contact-table tbody').on('click', 'tr', function () {
                var id = $(this).find(">:first-child").text();
                var index = $.inArray(id, selected);
                if (index === -1) {
                    selected.push(id);
                } else {
                    selected.splice(index, 1);
                }
                $(this).toggleClass('selected');
            });

            $('#btnDeleteContact').on("click",function () {
                var selects = [];
                $('#contact-table>tbody>tr').each(function (e) {
                    if($(this).hasClass('selected')){
                        var id = parseInt($(this).find(">:first-child").text());
                        selects.push(id);
                    }
                });
                if(selects.length <= 0){
                    alert("Select contact so you want to delete");
                } else{
                    if(confirm("Are you sure to delete?")){
                        var payLoad = {"contactIds" : selects};
                        $.ajax({
                            url:'{{route('admin.contacts.delete')}}',
                            type: 'POST',
                            contentType: 'application/json;charset=utf8',
                            data : JSON.stringify(payLoad),
                            success : function () {
                                location.reload();
                            }
                        });
                    }
                }
            });

            $('#btnSendMail').on('click', function () {
                var selects = [];
                $('#contact-table>tbody>tr').each(function (e) {
                    if($(this).hasClass('selected')){
                        var id = parseInt($(this).find(">:first-child").text());
                        selects.push(id);
                    }
                });
                if (selects.length <= 0){
                    alert('Choose email before send mail !!!');
                } else {
                    $.ajax({
                        url: '{{route('admin.contacts.sendMail')}}',
                        type: 'POST',
                        contentType: 'application/json;charset=utf8',
                        data: JSON.stringify({'Ids' : selects}),
                        success: function (count) {
                            alert('Send mail success for '+ count +' user .');
                            $('#contact-table>tbody>tr').removeClass('selected');
                        }
                    });
                }
            });
        });

    </script>
@endpush
