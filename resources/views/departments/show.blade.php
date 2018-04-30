@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($department))
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$department->name}}</div>

                <div class="panel-body">
                    {{$department->description}} <br>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Department not found</div>

                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection