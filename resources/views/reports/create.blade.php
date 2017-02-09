@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Create new task</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('weekreports.store')}}">
                {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('weeknumber') ? ' has-error' : '' }}">
                        <label for="weeknumber" class="col-md-4 control-label">Weeknumber: </label>

                        <div class="col-md-6">
                            <input id="weeknumber" type="number" class="form-control" name="weeknumber" value="{{ old('weeknumber') }}">

                            @if ($errors->has('weeknumber'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('weeknumber') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('startmeeting') ? ' has-error' : '' }}">
                        <label for="startmeeting" class="col-md-4 control-label">startmeeting: </label>

                        <div class="col-md-6">
                            <textarea id="startmeeting" class="form-control" name="startmeeting">{{ old('startmeeting') }}</textarea>

                            @if ($errors->has('startmeeting'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('startmeeting') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('endmeeting') ? ' has-error' : '' }}">
                        <label for="endmeeting" class="col-md-4 control-label">endmeeting: </label>

                        <div class="col-md-6">
                            <textarea id="endmeeting" class="form-control" name="endmeeting">{{ old('endmeeting') }}</textarea>

                            @if ($errors->has('endmeeting'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('endmeeting') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

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
@endsection