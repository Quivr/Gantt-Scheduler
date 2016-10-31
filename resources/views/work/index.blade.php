@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($works))
        <ul class="list-group">
                @foreach($works as $work)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-6">
                        User: <a href="{{route('users.show', [$work->user->id])}}">{{$work->user->name}}</a>
                        Task: <a href="{{route('tasks.show', [$work->task->id])}}">{{$work->task->title}}</a><br>
                        Date: {{$work->date}}
                        Start: {{$work->started_at}} End: {{$work->ended_at}}
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
    @else
    <h1>No logs</h1>
    @endif
</div>
@endsection
