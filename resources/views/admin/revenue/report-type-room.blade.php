@extends('layouts.admin')
@section('title','Report Type Room')
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Report Type Room Hotel</h3>
        </div>
    </div>

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-danger pl-3 mt-5 mb-5" style="border-left: 3px solid #0b93d5">Report month</h3>
            </div>
        </div>
        <div id="curve_chart" style="width: 100%; height: 500px"></div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-danger pl-3 mt-5 mb-5" style="border-left: 3px solid #0b93d5">Report percentage</h3>
            </div>
        </div>
        <div id="piechart_3d" style="width: 100%; height: 500px;"></div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(reportTypeRoomMonth);
        google.charts.setOnLoadCallback(reportTypeRoom);

        function reportTypeRoomMonth() {
            var data = google.visualization.arrayToDataTable(<?= json_encode($curveChart) ?>);

            var options = {
                title: 'Revenue type room by month',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }


        function reportTypeRoom() {
            var data = google.visualization.arrayToDataTable(<?= json_encode($chartTypeRooms) ?>);

            var options = {
                title: 'Revenue statistics by percentage',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>
@endpush


