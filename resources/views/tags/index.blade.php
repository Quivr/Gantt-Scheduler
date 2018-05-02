@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($tags))
    @foreach($tags as $tag)
    <div class="panel-group">
        <div class="panel panel-default">
            <a>
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="{{route('tags.show', [$tag->id])}}">{{$tag->name}}</a></h4>
                </div>
            </a>
        </div>
    </div>
    @endforeach
    
    @else
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">No tags</div>

                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
