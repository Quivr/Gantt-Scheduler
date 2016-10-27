@extends('layouts.app')

@section('js')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['gantt']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {


      var jsonData = $.ajax({
          url: "{{route('tasks.data')}}",
          dataType: "json",
          async: false
          }).responseText;

      var rows = new google.visualization.DataTable(jsonData);

      var options = {
        height: rows.getNumberOfRows() * 30 + 50,
        gantt: {
          trackHeight: 30
        }
      };

      var chart = new google.visualization.Gantt(document.getElementById('chart_div'));
      chart.draw(rows, options);
    }
  </script>
@endsection

@section('content')
<div class="container-fluid">
  <div id="chart_div"></div>
</div>
@endsection