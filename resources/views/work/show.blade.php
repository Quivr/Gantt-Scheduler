@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($work))
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @if(isset($work->task))
                    <div class="panel-heading">{{$work->task->title}}</div>
                @else
                    <div class="panel-heading">Geen taak</div>
                @endif

                <div class="panel-body">
                    {{$work->description}} <br>
                    Date: {{$work->date}} <br>
                    Start: {{$work->started_at}} <br>
                    End: {{$work->ended_at}} <br>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Log item not found</div>

                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection