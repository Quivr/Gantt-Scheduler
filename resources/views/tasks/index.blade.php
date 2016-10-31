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
                        <div class="col-sm-2">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('tasks.destroy', [$task->id])}}">
                                <input type="hidden" name="_method" value="DELETE">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </li>
                @endforeach
        </ul>
    @else
    <h1>No tasks found</h1>
    @endif
</div>
@endsection
