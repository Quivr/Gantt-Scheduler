@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Edit task</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('tasks.update', [$task->id])}}">
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-sm-6">
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

                        <div class="form-group{{ $errors->has('startTime') ? ' has-error' : '' }}">
                            <label for="startTime" class="col-md-4 control-label">start time</label>

                            <div class="col-md-6">
                                <input type="time" id="startTime" class="form-control" name="startTime" value="{{$task->startTime}}">

                                @if ($errors->has('startTime'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('startTime') }}</strong>
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

                        <div class="form-group{{ $errors->has('endTime') ? ' has-error' : '' }}">
                            <label for="endTime" class="col-md-4 control-label">end time</label>

                            <div class="col-md-6">
                                <input type="time" id="endTime" class="form-control" name="endTime" value="{{$task->endTime}}">

                                @if ($errors->has('endTime'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('endTime') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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
                    <div class="col-sm-6">

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

                        @if(isset($departments))
                        <div class="form-group{{ $errors->has('deparment') ? ' has-error' : '' }}">
                            <label for="department" class="col-md-4 control-label">department</label>

                            <div class="col-md-6">
                                <select id="department" class="form-control" name="department">
                                    <option></option>
                                    @foreach($departments as $department)
                                        @if($task->department_id == $department->id)
                                            <option value="{{$department->id}}" selected>{{$department->name}}</option>
                                        @else
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('department'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if(isset($tags))
                        <div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }}">
                            <label for="tag" class="col-md-4 control-label">tag</label>

                            <div class="col-md-6">
                                <select id="tag" class="form-control" name="tag">
                                    <option></option>
                                    @foreach($tags as $tag)
                                        @if($task->tag_id == $tag->id)
                                            <option value="{{$tag->id}}" selected>{{$tag->name}}</option>
                                        @else
                                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('tag'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tag') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </form>
            
            <form class="form-horizontal" role="form" method="POST" action="{{ route('tasks.destroy', [$task->id])}}">
                <input type="hidden" name="_method" value="DELETE">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">New dependency</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('tasks.createDependency', [$task->id])}}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('manager') ? ' has-error' : '' }}">
                    <label for="dependency" class="col-md-4 control-label">Task</label>

                    <div class="col-md-6">
                        <select id="dependency" class="form-control" name="dependency">
                            <option></option>
                            @if(isset($tasks))
                                @foreach($tasks as $task_temp)
                                    @if($task->id != $task_temp->id)
                                        <option value="{{$task_temp->id}}">{{$task_temp->title}}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>

                        @if ($errors->has('dependency'))
                            <span class="help-block">
                                <strong>{{ $errors->first('dependency') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    @if(isset($task->dependencies))
        @foreach($task->dependencies as $dependency)
            <div class="panel panel-default">
                <div class="panel-heading">{{$dependency->title}}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('tasks.deleteDependency', [$task->id, $dependency->id])}}">
                        <input type="hidden" name="_method" value="DELETE">
                        {{ csrf_field() }}

                        <p>start: {{$dependency->startDate}}</p>
                        <p>end: {{$dependency->endDate}}</p>

                        <div class="form-group">
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-danger">
                                    Delete
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        @endforeach
    @endif

</div>
@endsection
