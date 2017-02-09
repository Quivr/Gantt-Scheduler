@extends('layouts.app')

@section('content')
    <div class="container">
    @if(isset($reports))
        <ul class="list-group">
        @foreach($reports as $report)
            <li class="list-group-item">
                <a href="{{route("weekreports.show",["id"=>$report->id])}}">Week {{$report->weeknumber}}</a>
            </li>
        @endforeach
        </ul>
    @else
        <p>geen verslagen gevonden</p>
    @endif
    </div>
@endsection