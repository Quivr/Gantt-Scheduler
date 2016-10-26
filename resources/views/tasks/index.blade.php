@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($tasks))
    @foreach($tasks as $task)
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">{{$task->title}}: &nbsp &nbsp {{$task->startDate}} : {{$task->endDate}} </h4>
                <a href="{{route('tasks.edit', [$task->id])}}">Edit</a> <br>
                <a data-toggle="collapse" href="#collapse{{$task->id}}">Expand</a>
            </div>
            <div id="collapse{{$task->id}}" class="panel-collapse collapse">
                <ul class="list-group">
                </ul>
            </div>
        </div>
    </div>
    @endforeach
    
    @else
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">No tasks found</div>

                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
