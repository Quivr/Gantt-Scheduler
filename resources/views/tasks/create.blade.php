@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create new task</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('tasks.store')}}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}">

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
                                <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('startDate') ? ' has-error' : '' }}">
                            <label for="startDate" class="col-md-4 control-label">start date</label>

                            <div class="col-md-6">
                                <input type="date" id="startDate" class="form-control" name="startDate" value="{{ date('Y-m-d')}}">

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
                                <input type="date" id="endDate" class="form-control" name="endDate" value="{{ date('Y-m-d') }}">

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
                                    <option value="{{$user->id}}">{{$user->name}}</option>
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
                                    <option value="{{$resource->id}}">{{$resource->name}}</option>
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
                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            <label for="department" class="col-md-4 control-label">department</label>

                            <div class="col-md-6">
                                <select id="department" class="form-control" name="department">
                                    <option></option>
                                    @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
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


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Opslaan
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
