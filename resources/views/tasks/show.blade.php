@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($task))
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$task->title}}</div>

                <div class="panel-body">
                    {{$task->description}} <br>
                    Start: {{$task->startDate}} <br>
                    End: {{$task->endDate}} <br>
                    @if(isset($task->manager))
                    Manager: <a href="{{route('users.show', [$task->manager->id])}}">{{$task->manager->name}}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Task not found</div>

                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection