@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            @if(isset($report))
            <div class="panel-heading">Report for week {{$report->weeknumber}}</div>
            <div class="panel-body">
                <h3>Start meeting</h3>
                <p>{{$report->startmeeting}}</p>
                <h3>End meeting</h3>
                <p>{{$report->endmeeting}}</p>
                <a href="{{route("weekreports.edit", ["id"=>$report->id])}}">Edit</a>
            </div>
            @else
                <div class="panel-heading">Report not found</div>
            @endif
        </div>
    </div>
@endsection