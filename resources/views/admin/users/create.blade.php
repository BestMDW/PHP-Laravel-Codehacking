@extends('layouts.admin')
@section('content')
    <h1>Create Users</h1>
    {!! Form::open(['method' => 'POST', 'action' => 'AdminUsersController@store', 'files' => true]) !!}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            @if ($errors->has('name'))
                <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('file', 'Avatar:') !!}
            {!! Form::file('file', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
            {!! Form::label('role_id', 'Role:') !!}
            {!! Form::select('role_id', ['' => 'Choose Options'] + $roles, null, ['class' => 'form-control']) !!}
            @if ($errors->has('role_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('role_id') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }}">
            {!! Form::label('is_active', 'Status:') !!}
            {!! Form::select('is_active', $statusFieldOptions, 0, ['class' => 'form-control']) !!}
            @if ($errors->has('is_active'))
                <span class="help-block">
                    <strong>{{ $errors->first('is_active') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            {!! Form::submit('Create User', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
    @if($errors->count() > 0)
        <ul>
        @foreach($errors as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    @endif
@endsection