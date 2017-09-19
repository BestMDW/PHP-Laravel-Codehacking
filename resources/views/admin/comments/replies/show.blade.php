@extends('layouts.admin')
@section('content')
    <h1>Comments Replies</h1>
    @if($replies->count() > 0)
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Email</th>
                <th>Comment</th>
                <th>Created at</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($replies as $reply)
                <tr>
                    <td>{{ $reply->id }}</td>
                    <td>{{ $reply->author }}</td>
                    <td>{{ $reply->email }}</td>
                    <td>{{ $reply->body }}</td>
                    <td>{{ $reply->created_at->diffForHumans() }}</td>
                    <td><a href="{{ route('home.post', $reply->comment->post->slug) }}">View Post</a></td>
                    <td>
                        @if($reply->is_active == 1)
                            {!! Form::open(['method' => 'PATCH', 'action' => ['CommentsRepliesController@update', $reply->id]]) !!}
                            <input type="hidden" name="is_active" value="0">
                            <div class="form-group">
                                {!! Form::submit('Un-approve', ['class' => 'btn btn-info']) !!}
                            </div>
                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['method' => 'PATCH', 'action' => ['CommentsRepliesController@update', $reply->id]]) !!}
                            <input type="hidden" name="is_active" value="1">
                            <div class="form-group">
                                {!! Form::submit('Approve', ['class' => 'btn btn-success']) !!}
                            </div>
                            {!! Form::close() !!}
                        @endif
                    </td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'action' => ['CommentsRepliesController@destroy', $reply->id]]) !!}
                        <div class="form-group">
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-5">
                {{ $replies->links() }}
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            No comments.
        </div>
    @endif
@stop