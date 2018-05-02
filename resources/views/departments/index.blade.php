@extends('layouts.app')

@section('content')
<?php $user = Auth::user() ?>
<div class="container">
    @if(isset($departments))
    @foreach($departments as $department)
    <div class="panel-group">
        <div class="panel panel-default">
            <a>
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="{{route('departments.show', [$department->id])}}">{{$department->name}}</a>
                        @if($user->department->id === $department->id)
                            (Current department)
                        @endif
                    </h4>
                </div>
            </a>
            <div class="panel-collapse collapse in">
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{route('departments.show', [$department->id])}}">Show</a></li>
                    <li class="list-group-item"><a href="{{route('departments.edit', [$department->id])}}">Edit</a></li>
                    <li class="list-group-item">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('setCurrentDepartment', [$department->id])}}">
                            <input type="hidden" name="_method" value="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Set as current department</button>
                        </form>
                    </li>
                    <li class="list-group-item">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('departments.destroy', [$department->id])}}">
                            <input type="hidden" name="_method" value="DELETE">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
    
    @else
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">No departments</div>

                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
