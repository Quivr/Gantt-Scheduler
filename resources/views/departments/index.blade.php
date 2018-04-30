@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($departments))
    @foreach($departments as $department)
    <div class="panel-group">
        <div class="panel panel-default">
            <a>
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="{{route('departments.show', [$department->id])}}">{{$department->name}}</a></h4>
                </div>
            </a>
            <div class="panel-collapse collapse in">
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{route('departments.show', [$department->id])}}">Show</a></li>
                    <li class="list-group-item"><a href="{{route('departments.edit', [$department->id])}}">Edit</a></li>
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
