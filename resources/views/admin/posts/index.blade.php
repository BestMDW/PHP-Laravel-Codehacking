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
                <th>Body</th>
                <th>Created</th>
                <th>Updated</th>
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
                <td>{{ str_limit($post->body, 30) }}</td>
                <td>{{ $post->created_at->diffForHumans() }}</td>
                <td>{{ $post->updated_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection