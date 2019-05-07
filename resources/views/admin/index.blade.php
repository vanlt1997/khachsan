@extends('layouts.admin')
@section('title','Admin')
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">VanStar</h3>
        </div>
    </div>

@endsection
@section('content')
    <div class="container">
        <section class="content">
            <div class="row mt-5">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner col-md-6" style="float: left;" href="{{route('admin.orders.index')}}">
                            <h3 id="orders"></h3>
                            <p >Orders</p>
                        </div>
                        <div class="inner col-md-6" style="float: right;" href="{{route('admin.orders.wait')}}">
                            <h3 class="orderWait"></h3>
                            <p>Orders Wait</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <a href="{{route('admin.orders.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6" >
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>2</h3>

                            <p>Report</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('admin.revenues.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6" >
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 id="users"></h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('admin.users.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6" >
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 id="rooms"></h3>

                            <p>Rooms</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-home"></i>
                        </div>
                        <a href="{{route('admin.rooms.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <div class="row mt-5">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="ion ion-ios-gear-outline"></i></span>

                        <div class="info-box-content">
                            <a href="{{route('admin.type-rooms.index')}}"><span class="info-box-text">Type Room</span></a>
                            <span class="info-box-number" id="typeRooms"></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12" >
                    <div class="info-box">
                        <span class="info-box-icon bg-dark"><i class="fa fa-safari"></i></span>

                        <div class="info-box-content">
                            <a href="{{route('admin.promotions.index')}}"><span class="info-box-text">Promotions</span></a>
                            <span class="info-box-number" id="promotions"></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12" >
                    <div class="info-box">
                        <span class="info-box-icon bg-info-gradient"><i class="fa fa-envelope"></i></span>

                        <div class="info-box-content">
                            <a href="{{route('admin.contacts.index')}}"><span class="info-box-text">Contacts</span></a>
                            <span class="info-box-number" id="contacts"></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12" >
                    <div class="info-box">
                        <span class="info-box-icon bg-primary-gradient"><i class="fa fa-image"></i></span>

                        <div class="info-box-content">
                            <a href="{{route('admin.library-images.index')}}"><span class="info-box-text">Images</span></a>
                            <span class="info-box-number" id="images"></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <a href="{{route('admin.revenues.index')}}" class="text-danger pl-3 mt-5" style="border-left: 3px solid #0b93d5">Report during year</a>
                </div>
                <div id="chart_year" class="mt-5" style="width: 100%; height: 500px;"></div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <a href="{{route('admin.calendars.rooms')}}" class="text-danger pl-3 mt-5 mb-5" style="border-left: 3px solid #0b93d5">Calendar</a>
                </div>
                <div class="col-md-12 mt-5">
                    <div id="calendar-room"></div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.load("current", {packages:["timeline"]});
        $(document).ready(function () {
            setInterval(function () {
                this.loadData()
            }, 1000);
            setInterval(function () {

            }, 1000);
        });

        function chartYear(chartYear) {
            var data = google.visualization.arrayToDataTable(JSON.parse(chartYear));

            var options = {
                title: 'Report',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_year'));

            chart.draw(data, options);
        }

        function drawChart(data) {
            var container = document.getElementById('calendar-room');
            var chart = new google.visualization.Timeline(container);
            var dataTable = new google.visualization.DataTable();
            dataTable.addColumn({type: 'string', id: 'Type Room'});
            dataTable.addColumn({type: 'string', id: 'Room'});
            dataTable.addColumn({type: 'date', id: 'Start'});
            dataTable.addColumn({type: 'date', id: 'End'});
            var drawCharts = [];
            data.forEach(function (item) {
                var e = [item[0], item[1], new Date(item[2].date), new Date(item[3].date)];
                drawCharts.push(e);
            });
            dataTable.addRows(drawCharts);
            chart.draw(dataTable);
        }

        function loadData() {
            $.ajax({
                type: 'post',
                url: '{{route('admin.index')}}',
                success: function (data) {
                    var html = '', url;
                    $('.item-wait').remove();
                    $('.orderWait').text(data['dataWait'].length);
                    $('.orderWaitMessage').text(data['dataWait'].length + ' Notifications');
                    $('#orders').text(data['orders']);
                    $('#users').text(data['users']);
                    $('#rooms').text(data['rooms']);
                    $('#typeRooms').text(data['typeRooms']);
                    $('#promotions').text(data['promotions']);
                    $('#contacts').text(data['contacts']);
                    $('#images').text(data['images']);
                    google.charts.setOnLoadCallback(chartYear(data['chartYear']));
                    google.charts.setOnLoadCallback(drawChart(data['data']));
                    data['dataWait'].forEach(function (order, i) {
                        url = "{{route('admin.orders.wait.edit', ':order')}}";
                        url = url.replace(':order', order.id);
                        if (i <5 ) {
                            html += '<a href="'+ url +'" class="dropdown-item item-wait" ><i class="fa fa-star-o mr-2 text-danger"></i>'+ order.user.name +' <span class="float-right text-muted text-sm">'+ order.date +'</span></a>'
                        }
                    });
                    $('#showOrderWait').append(html);
                }
            });
        }
    </script>
@endpush




