@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($resources))
    @foreach($resources as $resource)
    <div class="panel-group">
        <div class="panel panel-default">
            <a data-toggle="collapse" href="#collapse{{$resource->id}}">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="{{route('resources.show', [$resource->id])}}">{{$resource->name}}</a></h4>
                </div>
            </a>
            <div id="collapse{{$resource->id}}" class="panel-collapse collapse in">
                <ul class="list-group">
                    <li class="list-group-item">Description: {{$resource->description}}</li>
                    <li class="list-group-item"><a href="{{route('resources.edit', [$resource->id])}}">Edit</a></li>
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
