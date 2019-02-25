@extends('layouts.admin')
@section('title','Service')
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Services</h3>
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
            <tbody>
            @foreach($services as $service)
                <tr id="row{{$service->id}}">
                    <td>{{$service->id}}</td>
                    <td class="name{{$service->id}}">{{$service->name}}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary btn-edit" id="{{$service->id}}" data-toggle="modal" data-target="#service"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-sm btn-outline-danger btn-delete" id="{{$service->id}}"><i
                                class="fa fa-trash"></i></button>
                    </td>
                </tr>


            @endforeach
            </tbody>
        </table>
    </div>
    <div class="container" style="clear: both">
        <button class="btn btn-sm btn-outline-info  btn-add" data-toggle="modal" data-target="#service"><i
                class="fa fa-plus-circle"></i> Add</button>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="service" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.services.action')}}">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <input type="text" name="id" id="id-service" hidden>
                            </div>
                            <div class="row">
                                <div class="col-md-4 text-right">
                                    <label for="name">Name <span class="text-danger">&hercon;</span> :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="name" id="name-service" class="form-control">
                                    <div class="error-content">
                                        @if($errors->has('name'))
                                            <p class="text-danger"><i
                                                    class="fa fa-exclamation-circle"></i> {{$errors->first('name')}}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-close" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-primary  btn-service">Add</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        String.prototype.replaceAll = function (arrayKeyValue) {
            var _this = this;
            arrayKeyValue.forEach(function (KeyValue) {
                _this = _this.replace(new RegExp('[' + KeyValue.key + ']', 'g'), KeyValue.value);
            });
            return _this;
        };
        $(document).ready(function () {
            $('.btn-delete').click(function () {
                var id = $(this).attr('id');
                let data = {"id": id};
                $.ajax({
                    url: '{{route('admin.services.delete')}}',
                    type: 'POST',
                    contentType: 'application/json;charset=utf8',
                    data: JSON.stringify(data),
                    success: function (rep) {
                        console.log(rep);
                        $('#row'+id).remove();
                    }
                });
            });

            $('.btn-edit').click(function () {
                var id = $(this).attr('id');
                $('#id-service').val(id);
                var name = $('.name'+id).html();
                $('#name-service').val(name);
            });

            $('.btn-add').click(function () {
                $('#id-service').val('0');
                $('#name-service').val('');
            });

            $('.btn-service').click(function () {
                var id =$('#id-service').val();
                var name = $('#name-service').val();
                let data= {"id": id, "name": name};
                $.ajax({
                    url: '{{route('admin.services.action')}}',
                    type: 'POST',
                    contentType: 'application/json;charset=utf8',
                    data: JSON.stringify(data),
                    success: function (rep) {
                        if (id == "0")
                        {   
                            var html = '<tr>' +
                                '<td>'+rep.id+'</td>' +
                                '<td>'+rep.name+'</td>'+
                                '</tr>';
                            $('#room-table > tbody').before(html);
                        } else {
                            $('.name'+id).html(name);
                        }
                        $('.btn-close').click();
                    }
                })
            })
        })
        /*function templateRow(params) {
            const {id, name} = params;
            let tmp = '<tr id="row{id}"><td>{id}</td><td>{name}</td>' +
                '<td><button class="btn btn-danger btnDelete" id="{id}">Delete</button></td>' +
                '</tr>';
            return tmp.replaceAll([
                {key: "id", value: id},
                {key: "name", value: name},
            ]);
        }

        function test() {
            $.ajax({
                url: '',
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
        }*/


    </script>
@endpush
