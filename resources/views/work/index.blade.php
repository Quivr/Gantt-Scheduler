@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($users as $user)
        <h2>{{$user->name}}</h2>
        <ul class="list-group">
                @foreach($user->works as $task)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-6">
                        Task: <a href="{{route('tasks.show', [$task->id])}}">{{$task->title}}</a><br>
                        Date: {{$task->pivot->date}}
                        Start: {{$task->pivotstarted_at}} End: {{$task->pivot->ended_at}}
                        </div>
                        <div class="col-sm-2"><a class="btn btn-primary" href="{{route('works.show', [$task->pivot->id])}}">Show</a></div>
                        <div class="col-sm-2"><a class="btn btn-primary" href="{{route('works.edit', [$task->pivot->id])}}">Edit</a></div>
                        <div class="col-sm-2">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('works.destroy', [$task->pivot->id])}}">
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
</div>
@endsection
