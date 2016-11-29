@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Edit log item</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('works.update', [$work->id])}}">
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-sm-6">

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control" name="description">{{$work->description}}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('started_at') ? ' has-error' : '' }}">
                            <label for="started_at" class="col-md-4 control-label">Started at</label>

                            <div class="col-md-6">
                                <input type="time" id="started_at" class="form-control" name="started_at" value="{{$work->started_at}}">

                                @if ($errors->has('started_at'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('started_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ended_at') ? ' has-error' : '' }}">
                            <label for="ended_at" class="col-md-4 control-label">Ended at</label>

                            <div class="col-md-6">
                                <input type="time" id="ended_at" class="form-control" name="ended_at" value="{{$work->ended_at}}">

                                @if ($errors->has('ended_at'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ended_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label for="date" class="col-md-4 control-label">Date</label>

                            <div class="col-md-6">
                                <input type="date" id="date" class="form-control" name="date" value="{{$work->date}}">

                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if(isset($tasks))
                        <div class="form-group{{ $errors->has('task') ? ' has-error' : '' }}">
                            <label for="task" class="col-md-4 control-label">master task</label>

                            <div class="col-md-6">
                                <select id="task" class="form-control" name="task">
                                    <option></option>
                                    @foreach($tasks as $task)
                                        @if(isset($work->task))
                                            @if($work->task->id == $task->id)
                                                <option value="{{$task->id}}" selected>{{$task->title}}</option>
                                            @else
                                                <option value="{{$task->id}}">{{$task->title}}</option>
                                            @endif
                                        @else
                                            <option value="{{$task->id}}">{{$task->title}}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('task'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('task') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
