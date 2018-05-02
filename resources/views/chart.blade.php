@extends('layouts.app')

@section('js')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['gantt']});
    google.charts.setOnLoadCallback(setupChart);
    var chart;
    var data;

    function setupChart(){
      chart = new google.visualization.Gantt(document.getElementById('chart_div'));
      drawChart();
    }

    function drawChart() {

      var dates = {};
      dates.color = $('#color').val();
      dates.start_date = $('#start_date').val();
      dates.end_date = $('#end_date').val();
      dates.department = $('#department').val();

      var jsonData = $.ajax({
          url: "{{route('tasks.data')}}",
          data: dates,
          dataType: "json",
          async: false
          }).responseText;

      data = new google.visualization.DataTable(jsonData);

      var options = {
        height: data.getNumberOfRows() * 30 + 50,
        gantt: {
          trackHeight: 30,
          criticalPathEnabled: true,
          criticalPathStyle: {
            stroke: '#e64a19',
            strokeWidth: 5
          }
        }
      };

      chart.draw(data, options);

      google.visualization.events.addListener(chart, 'select', selectHandler);
    }

    $('#submitbutton').click(drawChart);

    // The selection handler.
    // Loop through all items in the selection and concatenate
    // a single message from all of them.
    function selectHandler() {
        var selection = chart.getSelection();
        //selection[0].row]
        window.location = "{{url('tasks')}}"+"/"+data.getValue(selection[0].row,0)+"/edit";
    }
  </script>
@endsection

@section('content')
<?php 
  $date1 = date('Y-m-d');
  $date = new DateTime($date1);
  $date->sub(new DateInterval('P2W')); // P2W means period of 4 weeks
  $date2 = $date->format('Y-m-d');
  $date->add(new DateInterval('P6W')); // P2W means period of 4 weeks
  $date3 = $date->format('Y-m-d');
  $user = Auth::user();
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-9 col-lg-10">
      <div id="chart_div"></div>
    </div>

    
    
    <div class="col-sm-3 col-lg-2">
      <div class="form-group">
        <label for="color">Color grouping by</label>
        <select name="color" id="color" class="form-control">
          <option value="department">Department</option>
          <option value="resource">Resource</option>
          <option value="tag" selected>Tag</option>
        </select>

        <label for="department">Department</label>
        <select name="department" id="department" class="form-control">
          <option value="-1">Show all</option>
          @foreach ($departments as $department)
            @if($user->department->id === $department->id)
            <option value="{{$department->id}}" selected>{{$department->name}}</option>
            @else
            <option value="{{$department->id}}">{{$department->name}}</option>
            @endif
          @endforeach
        </select>
        
        <label for="start_date">Start date</label>
        <input name="start_date" type="date" class="form-control" id="start_date" value="{{$date2}}">

        <label for="end_date">End date</label>
        <input name="end_date" type="date" class="form-control" id="end_date" value="{{$date3}}">

        <button id="submitbutton" class="btn btn-primary">Send</button>
      </div>
    </div>
  </div>
</div>
@endsection