@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Your logged hours</div>

                <div class="panel-body">
                    @if(isset($weeks))
                        @foreach($weeks as $key=>$week)
                        Week {{$key}}, totaal gewerkte uren: <strong>{{gmdate("H:i:s", $week["duration"])}}</strong>
                        <ul class="list-group">
                            @foreach($week["works"] as $work)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6">
                                        @if(isset($work->task))
                                        Task: <a href="{{route('tasks.show', [$work->task->id])}}">{{$work->task->title}}</a><br>
                                        @else
                                        Task: NA
                                        @endif
                                        {{$work->description}} <br>
                                        Date: {{$work->date}}
                                        Start: {{$work->started_at}} End: {{$work->ended_at}} <br>
                                        Duration: {{gmdate("H:i:s", $work->duration)}}
                                    </div>
                                    <div class="col-sm-2"><a class="btn btn-primary" href="{{route('works.show', [$work->id])}}">Show</a></div>
                                    <div class="col-sm-2"><a class="btn btn-primary" href="{{route('works.edit', [$work->id])}}">Edit</a></div>
                                    <div class="col-sm-2">
                                        <form class="form-horizontal" role="form" method="POST" action="{{ route('works.destroy', [$work->id])}}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
