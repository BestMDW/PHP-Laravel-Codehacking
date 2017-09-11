@extends('layouts.admin')
@section('content')
    <h1>Media</h1>
    @if($photos)
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            @foreach($photos as $photo)
                <tr>
                    <td>{{ $photo->id }}</td>
                    <td><img src="{{ $photo->path }}" height="50" alt="" class="img-rounded"></td>
                    <td>{{ $photo->created_at->diffForHumans() }}</td>
                    <td>{{ $photo->updated_at->diffForHumans() }}</td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminMediasController@destroy', $photo->id]]) !!}
                            <div class="form-group">
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection