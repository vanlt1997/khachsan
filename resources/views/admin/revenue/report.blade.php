@extends('layouts.admin')
@section('title','Report')
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Report Hotel</h3>
        </div>
    </div>

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-danger pl-3 mt-5 mb-3" style="border-left: 3px solid #0b93d5">Report month</h3>
            </div>
        </div>
        <div id="chart_month" style="width: 100%; height: 500px;"></div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-danger pl-3 mt-5 mb-5" style="border-left: 3px solid #0b93d5">Quarterly revenue</h3>
            </div>
        </div>
        <div id="chart_quarterly" style="width: 100%; height: 500px;"></div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-danger pl-3 mt-5 mb-5" style="border-left: 3px solid #0b93d5">Report during year</h3>
            </div>
        </div>
        <div id="chart_year" style="width: 100%; height: 500px;"></div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(chartMonth);
        google.charts.setOnLoadCallback(chartQuarterly);
        google.charts.setOnLoadCallback(chartYear);

        function chartMonth() {
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable(<?= json_encode($chatMonth) ?>);


            var options = {
                title : 'Revenue of MayStar during month',
                vAxis: {title: 'Price'},
                hAxis: {title: 'Month'},
                seriesType: 'bars',
                series: {12: {type: 'line'}},
                annotations: {
                    boxStyle:{
                        stroke: '#d5d42c'
                    }
                }
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_month'));
            chart.draw(data, options);
        }

        function chartQuarterly() {
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable(<?= json_encode($chatQuarter) ?>);


            var options = {
                title : 'Revenue of MayStar during month',
                vAxis: {title: 'Price'},
                hAxis: {title: 'Quarterly'},
                seriesType: 'bars',
                series: {12: {type: 'line'}}
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_quarterly'));
            chart.draw(data, options);
        }

        function chartYear() {
            var data = google.visualization.arrayToDataTable(<?= json_encode($chartYear) ?>);

            var options = {
                title: 'Report',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_year'));

            chart.draw(data, options);
        }
    </script>
@endpush


