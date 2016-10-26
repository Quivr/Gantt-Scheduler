@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit task</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('tasks.update', [$task->id])}}">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{$task->title}}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control" name="description">{{$task->description}}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('percentcomplete') ? ' has-error' : '' }}">
                            <label for="percentcomplete" class="col-md-4 control-label">Percent Complete</label>

                            <div class="col-md-6">
                                <input type="number" id="percentcomplete" class="form-control" name="percentcomplete" value="{{$task->percentcomplete}}" min="0" max="100">

                                @if ($errors->has('percentcomplete'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('percentcomplete') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('startDate') ? ' has-error' : '' }}">
                            <label for="startDate" class="col-md-4 control-label">start date</label>

                            <div class="col-md-6">
                                <input type="date" id="startDate" class="form-control" name="startDate" value="{{$task->startDate}}">

                                @if ($errors->has('startDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('startDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('endDate') ? ' has-error' : '' }}">
                            <label for="endDate" class="col-md-4 control-label">end date</label>

                            <div class="col-md-6">
                                <input type="date" id="endDate" class="form-control" name="endDate" value="{{$task->endDate}}">

                                @if ($errors->has('endDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('endDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if(isset($users))
                        <div class="form-group{{ $errors->has('manager') ? ' has-error' : '' }}">
                            <label for="manager" class="col-md-4 control-label">manager</label>

                            <div class="col-md-6">
                                <select id="manager" class="form-control" name="manager" value="">
                                    <option></option>
                                    @foreach($users as $user)
                                        @if($user->id == $task->manager_id)
                                            <option value="{{$user->id}}" selected>{{$user->name}}</option>
                                        @else
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('manager'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('manager') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if(isset($tasks))
                        <div class="form-group{{ $errors->has('manager') ? ' has-error' : '' }}">
                            <label for="master_task" class="col-md-4 control-label">master task</label>

                            <div class="col-md-6">
                                <select id="master_task" class="form-control" name="master_task">
                                    <option></option>
                                    @foreach($tasks as $master_task)
                                        @if($task->master_task_id == $master_task->id)
                                            <option value="{{$master_task->id}}" selected>{{$master_task->title}}</option>
                                        @elseif($task->id == $master_task->id)

                                        @else
                                            <option value="{{$master_task->id}}">{{$master_task->title}}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('master_task'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('master_task') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif


                        @if(isset($resources))
                        <div class="form-group{{ $errors->has('resource') ? ' has-error' : '' }}">
                            <label for="resource" class="col-md-4 control-label">resource</label>

                            <div class="col-md-6">
                                <select id="resource" class="form-control" name="resource">
                                    <option></option>
                                    @foreach($resources as $resource)
                                        @if($task->resource_id == $resource->id)
                                            <option value="{{$resource->id}}" selected>{{$resource->name}}</option>
                                        @else
                                            <option value="{{$resource->id}}">{{$resource->name}}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('resource'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('resource') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
