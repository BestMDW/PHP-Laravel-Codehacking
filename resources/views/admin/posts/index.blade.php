@extends('layouts.admin')
@section('content')
    @include('includes.toast_message')
    <h1>Posts</h1>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Owner</th>
                <th>Category</th>
                <th>Photo</th>
                <th>Title</th>
                <th>Created</th>
                <th>Updated</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        @if($posts->count() > 0)
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->category ? $post->category->name : 'Uncategorized' }}</td>
                <td class="text-center"><img src="{{ $post->photo ? $post->photo->path : $placeholder }}" height="50" class="img-rounded" alt=""></td>
                <td><a href="{{ route('admin.posts.edit', $post->id) }}">{{ $post->title }}</a></td>
                <td>{{ $post->created_at->diffForHumans() }}</td>
                <td>{{ $post->updated_at->diffForHumans() }}</td>
                <td><a href="{{ route('home.post', $post->slug) }}">View Post</a></td>
                <td><a href="{{ route('admin.comments.show', $post->id) }}">View Comments</a></td>
            </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{ $posts->links() }}
        </div>
    </div>
@endsection