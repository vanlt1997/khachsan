@extends('layouts.admin')
@section('title','Calendar Room')
@section('header')
    <div class="container">
        <div class="title-header">
            <h3 class="text-center">Calendar Room</h3>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-danger pl-3 mt-5 mb-5" style="border-left: 3px solid #0b93d5">Calendar all room</h3>
            </div>
            <div class="col-md-12">
                <div id="calendar-room"></div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["timeline"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var container = document.getElementById('calendar-room');
            var chart = new google.visualization.Timeline(container);
            var dataTable = new google.visualization.DataTable();
            dataTable.addColumn({ type: 'string', id: 'Type Room' });
            dataTable.addColumn({ type: 'string', id: 'Room' });
            dataTable.addColumn({ type: 'date', id: 'Start' });
            dataTable.addColumn({ type: 'date', id: 'End' });
            dataTable.addRows([
                @foreach($data as $item)
                    [
                    '{{$item[0]}}',
                    '{{$item[1]}}',
                    new Date({{\Carbon\Carbon::parse($item[2])->format('Y')}}, {{\Carbon\Carbon::parse($item[2])->format('m-1')}}, {{\Carbon\Carbon::parse($item[2])->format('d')}}),
                    new Date({{\Carbon\Carbon::parse($item[3])->format('Y')}}, {{\Carbon\Carbon::parse($item[3])->format('m-1')}}, {{\Carbon\Carbon::parse($item[3])->format('d')}})
                    ],
                @endforeach
                ]
            );

            var options = {
                timeline: { colorByRowLabel: true }
            };

            chart.draw(dataTable, options);
        }

    </script>

@endpush


