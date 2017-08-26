@extends('layouts.admin')
@section('content')
    @include('includes.toast_message')
    <h1>Categories</h1>
    <div class="col-sm-3">
        {!! Form::open(['method' => 'POST', 'action' => 'AdminCategoriesController@store']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Add Category', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
    <div class="col-sm-9">
        @if($categories->count() > 0)
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td><a href="{{ route('admin.categories.edit', $category->id) }}">{{ $category->name }}</a></td>
                        <td>{{ $category->created_at ? $category->created_at->diffForHumans() : 'no date' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection