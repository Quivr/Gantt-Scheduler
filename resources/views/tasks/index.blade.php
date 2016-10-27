@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($tasks))
        <ul class="list-group">
                @foreach($tasks as $task)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-8"><a href="{{route('tasks.show', [$task->id])}}">{{$task->title}}</a></div>
                        <div class="col-sm-2"><a class="btn btn-primary" href="{{route('tasks.edit', [$task->id])}}">Edit</a></div>
                        <div class="col-sm-2"><a class="btn btn-danger" href="#">Delete</a></div>
                    </div>
                </li>
                @endforeach
        </ul>
    @else
    <h1>No tasks found</h1>
    @endif
</div>
@endsection
