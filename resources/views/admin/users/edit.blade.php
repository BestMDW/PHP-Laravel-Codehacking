@extends('layouts.admin')
@section('content')
    <h1>Edit User</h1>
    <div class="col-sm-3">
            <img src="{{ $user->photo_id ? $user->photo->path : $placeholder }}" alt="" class="img-responsive img-rounded">
    </div>
    <div class="col-sm-9">
        {!! Form::model($user, ['method' => 'PATCH', 'action' => ['AdminUsersController@update', $user->id], 'files' => true]) !!}
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
            @if($errors->has('email'))
                <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
            @if($errors->has('password'))
                <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('password_confirm') ? ' has-error' : '' }}">
            {!! Form::label('password_confirmation', 'Confirm Password:') !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            @if($errors->has('password_confirmation'))
                <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('photo_id', 'Avatar:') !!}
            {!! Form::file('photo_id', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
            {!! Form::label('role_id', 'Role:') !!}
            {!! Form::select('role_id', ['' => 'Choose Options'] + $roles, null, ['class' => 'form-control']) !!}
            @if($errors->has('role_id'))
                <span class="help-block">
                        <strong>{{ $errors->first('role_id') }}</strong>
                    </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }}">
            {!! Form::label('is_active', 'Status:') !!}
            {!! Form::select('is_active', $statusFieldOptions, null, ['class' => 'form-control']) !!}
            @if ($errors->has('is_active'))
                <span class="help-block">
                        <strong>{{ $errors->first('is_active') }}</strong>
                    </span>
            @endif
        </div>
        <div class="form-group">
            {!! Form::submit('Update', ['class' => 'btn btn-primary col-sm-2']) !!}
        </div>
        {!! Form::close() !!}
        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminUsersController@destroy', $user->id]]) !!}
            <div class="form-group">
                {!! Form::submit('Delete User', ['class' => 'btn btn-danger col-sm-2 pull-right']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection