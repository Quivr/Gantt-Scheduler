@extends('layouts.app')

@section('js')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['gantt']});
    google.charts.setOnLoadCallback(setupChart);
    var chart;

    function setupChart(){
      chart = new google.visualization.Gantt(document.getElementById('chart_div'));
      drawChart();
    }

    function drawChart() {

      var dates = {};
      dates.start_date = $('#start_date').val();
      dates.end_date = $('#end_date').val();

      var jsonData = $.ajax({
          url: "{{route('tasks.data')}}",
          data: dates,
          dataType: "json",
          async: false
          }).responseText;

      var data = new google.visualization.DataTable(jsonData);

      var options = {
        height: data.getNumberOfRows() * 30 + 50,
        gantt: {
          trackHeight: 30
        }
      };

      chart.draw(data, options);
    }

    $('#submitbutton').click(drawChart);
  </script>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-9 col-lg-10">
      <div id="chart_div"></div>
    </div>
    <div class="col-sm-3 col-lg-2">
      <div class="form-group">
        <label for="start_date">Start date</label>
        <input type="date" class="form-control" id="start_date" value="2017-01-01">

        <label for="end_date">End date</label>
        <input type="date" class="form-control" id="end_date" value="2018-01-01">

        <label for="resource"></label>

        <button id="submitbutton" class="btn btn-primary">Send</button>
      </div>
    </div>
  </div>
</div>
@endsection